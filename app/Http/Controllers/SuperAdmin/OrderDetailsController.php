<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Enums\PaymentMode;
use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderDetailsController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->string('search'));
        $paymentMode = $request->string('payment_mode')->toString();
        $paymentStatus = $request->string('payment_status')->toString();
        $fromDate = $request->string('from_date')->toString();
        $toDate = $request->string('to_date')->toString();

        // Since user fields (name, email, UID) are encrypted, we filter user IDs in memory 
        // to make them searchable, following the pattern used in the Users List.
        $matchedUserIds = [];
        if ($search !== '') {
            $searchTerm = $search;
            $matchedUserIds = User::query()
                ->where('role_type', 'user')
                ->get()
                ->filter(function ($user) use ($searchTerm) {
                    $searchable = [
                        $user->name,
                        $user->unique_sequence_number,
                    ];
                    foreach ($searchable as $val) {
                        if ($val && stripos((string)$val, $searchTerm) !== false) {
                            return true;
                        }
                    }
                    return false;
                })
                ->pluck('id')
                ->toArray();
        }

        $orders = Order::query()
            ->with([
                'user:id,name,first_name,last_name,email,unique_sequence_number',
                'courseDetail:id,couse_name',
            ])
            ->when($search !== '', function ($query) use ($matchedUserIds) {
                $query->whereIn('user_id', $matchedUserIds);
            })
            ->when($paymentMode !== '', function ($query) use ($paymentMode) {
                $query->where('payment_mode', $paymentMode);
            })
            ->when($paymentStatus !== '', function ($query) use ($paymentStatus) {
                $query->where('payment_status', $paymentStatus);
            })
            ->when($fromDate !== '', function ($query) use ($fromDate) {
                $query->whereDate('created_at', '>=', $fromDate);
            })
            ->when($toDate !== '', function ($query) use ($toDate) {
                $query->whereDate('created_at', '<=', $toDate);
            })
            ->latest('id')
            ->paginate(20)
            ->withQueryString();

        return view('super-admin.order-details.index', [
            'title' => 'Order Details',
            'orders' => $orders,
            'filters' => [
                'search' => $search,
                'payment_mode' => $paymentMode,
                'payment_status' => $paymentStatus,
                'from_date' => $fromDate,
                'to_date' => $toDate,
            ],
            'paymentModes' => collect(PaymentMode::cases())
                ->map(fn (PaymentMode $mode): array => [
                    'value' => $mode->value,
                    'label' => $mode->label(),
                ])
                ->values()
                ->all(),
            'paymentStatuses' => collect(PaymentStatus::cases())
                ->map(fn (PaymentStatus $status): array => [
                    'value' => $status->value,
                    'label' => $status->label(),
                ])
                ->values()
                ->all(),
        ]);
    }
}
