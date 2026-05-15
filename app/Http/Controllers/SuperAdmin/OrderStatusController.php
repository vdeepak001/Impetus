<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class OrderStatusController extends Controller
{
    public function index(\Illuminate\Http\Request $request): View
    {
        $search = trim((string) $request->string('search'));

        // Handle encrypted user fields for search
        $matchedUserIds = [];
        if ($search !== '') {
            $searchTerm = mb_strtolower($search);
            $matchedUserIds = \App\Models\User::query()
                ->select('id', 'name', 'first_name', 'last_name', 'email', 'unique_sequence_number')
                ->get()
                ->filter(function ($user) use ($searchTerm) {
                    return str_contains(mb_strtolower($user->name ?? ''), $searchTerm)
                        || str_contains(mb_strtolower($user->first_name ?? ''), $searchTerm)
                        || str_contains(mb_strtolower($user->last_name ?? ''), $searchTerm)
                        || str_contains(mb_strtolower($user->email ?? ''), $searchTerm)
                        || str_contains(mb_strtolower($user->unique_sequence_number ?? ''), $searchTerm);
                })
                ->pluck('id')
                ->toArray();
        }

        $orders = \App\Models\Order::with(['user', 'courseDetail'])
            ->when($search !== '', function ($query) use ($search, $matchedUserIds) {
                $query->where(function ($subQuery) use ($search, $matchedUserIds) {
                    $subQuery->whereIn('user_id', $matchedUserIds)
                        ->orWhereHas('courseDetail', function ($courseQuery) use ($search) {
                            $courseQuery->where('couse_name', 'like', '%'.$search.'%');
                        })
                        ->orWhere('id', 'like', '%'.$search.'%');
                });
            })
            ->latest('id')
            ->paginate(20)
            ->withQueryString();

        return view('super-admin.order-status.index', [
            'title' => 'Order Status',
            'orders' => $orders,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }
}
