<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\CourseDetail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        abort_unless($user && $user->role_type === 'user', 403);

        $items = CartItem::query()
            ->with('courseDetail')
            ->where('user_id', $user->id)
            ->latest('id')
            ->get();

        return view('cart.index', [
            'items' => $items,
        ]);
    }

    public function store(CourseDetail $course_detail): RedirectResponse
    {
        $user = auth()->user();
        abort_unless($user && $user->role_type === 'user', 403);

        if ((int) $course_detail->active_status !== 1) {
            abort(404);
        }

        if (! filled($user->state)) {
            return back()->with('error', 'Your state is not set. Please update your profile.');
        }

        $stateName = trim((string) $user->state);

        $stateCouncil = $course_detail->stateCouncils()
            ->where('active_status', true)
            ->whereHas('state', function ($stateQuery) use ($stateName) {
                $stateQuery->where('name', $stateName)->where('status', 'active');
            })
            ->first();

        if (! $stateCouncil) {
            return back()->with('error', 'This module is not available for your state.');
        }

        $mrp = $this->pivotScalar($stateCouncil->pivot?->mrp);
        $offerPrice = $this->pivotScalar($stateCouncil->pivot?->offer_price);
        $points = $this->pivotScalar($stateCouncil->pivot?->points);
        $validDays = $this->pivotScalar($stateCouncil->pivot?->valid_days);
        $passPercentage = $this->pivotScalar($stateCouncil->pivot?->pass_percentage);

        CartItem::query()->updateOrCreate(
            [
                'user_id' => $user->id,
                'course_detail_id' => $course_detail->id,
            ],
            [
                'state_council_id' => $stateCouncil->id,
                'mrp' => $mrp,
                'offer_price' => $offerPrice,
                'points' => $points,
                'valid_days' => $validDays,
                'pass_percentage' => $passPercentage,
            ]
        );

        return redirect()->route('cart.index')->with('success', 'Module added to cart.');
    }

    public function destroy(CourseDetail $course_detail): RedirectResponse
    {
        $user = auth()->user();
        abort_unless($user && $user->role_type === 'user', 403);

        $cartItem = CartItem::query()
            ->where('user_id', $user->id)
            ->where('course_detail_id', $course_detail->id)
            ->first();

        abort_unless($cartItem, 404);

        $cartItem->delete();

        return back()->with('success', 'Module removed from cart.');
    }

    public function checkout(): View|RedirectResponse
    {
        $user = auth()->user();
        abort_unless($user && $user->role_type === 'user', 403);

        $items = CartItem::query()
            ->where('user_id', $user->id)
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $txnId = 'IHS' . $user->id . 'T' . time();

        foreach ($items as $item) {
            \App\Models\Order::query()->create([
                'user_id' => $user->id,
                'course_detail_id' => $item->course_detail_id,
                'state_council_id' => $item->state_council_id,
                'payment_mode' => 'ccavenue',
                'start_date' => now(),
                'end_date' => now()->addDays($item->valid_days ?? 30),
                'remarks' => $txnId,
                'payment_status' => \App\Enums\PaymentStatus::Pending,
                'recorded_by_id' => null,
            ]);
        }

        $totalAmount = (float) $items->sum(function ($item) {
            return (int) ($item->offer_price ?? $item->mrp ?? 0);
        });

        $ccavenue = app(\App\Services\CCAvenueService::class);

        // Sanitize and pad billing parameters to ensure CCAvenue validations pass (especially for Card payments)
        $billingAddress = trim(($user->address_line_1 ?? '') . ' ' . ($user->address_line_2 ?? ''));
        if (empty($billingAddress)) {
            $billingAddress = 'Address Not Provided';
        } elseif (strlen($billingAddress) < 10) {
            $billingAddress = str_pad($billingAddress, 10, ' ');
        }

        $billingCity = trim($user->city ?? '');
        if (empty($billingCity)) {
            $billingCity = trim($user->state ?? 'Mumbai');
        }

        $billingZip = trim($user->zip_code ?? '');
        if (empty($billingZip) || !preg_match('/^[a-zA-Z0-9]{3,12}$/', $billingZip)) {
            $billingZip = '400001'; // Fallback to a valid default pin code format
        }

        $billingTel = preg_replace('/[^0-9]/', '', $user->phone ?? '');
        if (strlen($billingTel) < 10 || strlen($billingTel) > 15) {
            $billingTel = '9999999999'; // Fallback to a valid default 10-digit format
        }
        
        $params = [
            'merchant_id' => config('services.ccavenue.merchant_id'),
            'order_id' => $txnId,
            'amount' => number_format($totalAmount, 2, '.', ''),
            'currency' => 'INR',
            'redirect_url' => route('payment.ccavenue.callback'),
            'cancel_url' => route('payment.ccavenue.callback'),
            'language' => 'EN',
            'billing_name' => $user->name,
            'billing_email' => $user->email,
            'billing_tel' => $billingTel,
            'billing_address' => $billingAddress,
            'billing_city' => $billingCity,
            'billing_state' => $user->state ?? '',
            'billing_zip' => $billingZip,
            'billing_country' => $user->country ?? 'India',
        ];

        $merchantData = '';
        foreach ($params as $key => $value) {
            $merchantData .= $key . '=' . $value . '&';
        }
        $merchantData = rtrim($merchantData, '&');

        $encRequest = $ccavenue->encrypt($merchantData, config('services.ccavenue.working_key'));

        return view('cart.checkout_redirect', [
            'ccavenueUrl' => $ccavenue->getGatewayUrl(),
            'encRequest' => $encRequest,
            'accessCode' => config('services.ccavenue.access_code'),
        ]);
    }

    public function ccavenueCallback(\Illuminate\Http\Request $request): RedirectResponse
    {
        $encResp = $request->input('encResp') ?? $request->input('encResponse');

        if (! $encResp) {
            return redirect()->route('cart.index')->with('error', 'Invalid payment response received.');
        }

        $ccavenue = app(\App\Services\CCAvenueService::class);
        $decrypted = $ccavenue->decrypt($encResp, config('services.ccavenue.working_key'));

        parse_str($decrypted, $response);

        // Log decrypted CCAvenue response for transaction debugging
        \Illuminate\Support\Facades\Log::info('CCAvenue Decrypted Callback Response:', [
            'order_id' => $response['order_id'] ?? null,
            'order_status' => $response['order_status'] ?? null,
            'tracking_id' => $response['tracking_id'] ?? null,
            'failure_message' => $response['failure_message'] ?? null,
            'status_code' => $response['status_code'] ?? null,
            'status_message' => $response['status_message'] ?? null,
        ]);

        $orderId = $response['order_id'] ?? null;
        $orderStatus = $response['order_status'] ?? null;
        $trackingId = $response['tracking_id'] ?? null;
        $failureMessage = $response['failure_message'] ?? null;

        if (! $orderId) {
            return redirect()->route('cart.index')->with('error', 'Unable to retrieve order reference.');
        }

        $orders = \App\Models\Order::query()
            ->where('remarks', $orderId)
            ->where('payment_status', \App\Enums\PaymentStatus::Pending)
            ->get();

        if ($orders->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'No pending orders found for this transaction.');
        }

        $user = $orders->first()->user;

        if (strtolower($orderStatus) === 'success') {
            $courseNames = $orders->map(fn($o) => $o->courseDetail->couse_name ?? '')->filter()->implode(', ');
            foreach ($orders as $order) {
                $validDays = $order->start_date->diffInDays($order->end_date) ?: 30;
                $order->update([
                    'payment_status' => \App\Enums\PaymentStatus::Completed,
                    'start_date' => now(),
                    'end_date' => now()->addDays($validDays),
                    'remarks' => "CCAvenue Tracking ID: {$trackingId}",
                ]);

                try {
                    \Illuminate\Support\Facades\Mail::to($user->email)->send(
                        new \App\Mail\ModuleActivationMail($user, $order->courseDetail, $order)
                    );
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Failed to send module activation mail: ' . $e->getMessage());
                }
            }

            if (filled($user->phone) && !empty($courseNames)) {
                try {
                    app(\App\Services\SmsService::class)->sendPurchaseConfirmation($user->phone, $courseNames);
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Failed to send purchase confirmation SMS: ' . $e->getMessage());
                }
            }

            CartItem::query()->where('user_id', $user->id)->delete();

            auth()->login($user);

            return redirect()->route('profile')->with('success', 'Thank you! Your payment was successful and your courses have been activated.');
        }

        if (strtolower($orderStatus) === 'aborted') {
            foreach ($orders as $order) {
                $order->update([
                    'payment_status' => \App\Enums\PaymentStatus::Aborted,
                    'remarks' => "Aborted at gateway. Tracking ID: {$trackingId}",
                ]);
            }

            auth()->login($user);

            return redirect()->route('cart.index')->with('error', 'Payment was aborted. Please try again.');
        }

        // Default to Failed
        foreach ($orders as $order) {
            $order->update([
                'payment_status' => \App\Enums\PaymentStatus::Failed,
                'remarks' => "Failed at gateway. Tracking ID: {$trackingId}. Reason: {$failureMessage}",
            ]);
        }

        auth()->login($user);

        return redirect()->route('cart.index')->with('error', 'Payment failed. Reason: ' . ($failureMessage ?? 'Unknown error'));
    }

    private function pivotScalar(mixed $value): ?int
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_array($value)) {
            $value = $value[0] ?? null;
        }

        if ($value === null || $value === '') {
            return null;
        }

        return (int) $value;
    }
}
