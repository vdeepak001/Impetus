<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Enums\PaymentMode;
use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderDetailsController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->string('search'));
        $paymentMode = $request->string('payment_mode')->toString();
        $paymentStatus = $request->string('payment_status')->toString();

        $orders = Order::query()
            ->with([
                'user:id,name,first_name,last_name,email',
                'courseDetail:id,couse_name',
                'stateCouncil:id,council_name',
                'recordedBy:id,name,first_name,last_name',
            ])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->whereHas('user', function ($userQuery) use ($search) {
                            $userQuery
                                ->where('name', 'like', '%'.$search.'%')
                                ->orWhere('first_name', 'like', '%'.$search.'%')
                                ->orWhere('last_name', 'like', '%'.$search.'%')
                                ->orWhere('email', 'like', '%'.$search.'%');
                        })
                        ->orWhereHas('courseDetail', function ($courseQuery) use ($search) {
                            $courseQuery->where('couse_name', 'like', '%'.$search.'%');
                        })
                        ->orWhereHas('stateCouncil', function ($councilQuery) use ($search) {
                            $councilQuery->where('council_name', 'like', '%'.$search.'%');
                        })
                        ->orWhere('remarks', 'like', '%'.$search.'%');
                });
            })
            ->when($paymentMode !== '', function ($query) use ($paymentMode) {
                $query->where('payment_mode', $paymentMode);
            })
            ->when($paymentStatus !== '', function ($query) use ($paymentStatus) {
                $query->where('payment_status', $paymentStatus);
            })
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('super-admin.order-details.index', [
            'title' => 'Order Details',
            'orders' => $orders,
            'filters' => [
                'search' => $search,
                'payment_mode' => $paymentMode,
                'payment_status' => $paymentStatus,
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
