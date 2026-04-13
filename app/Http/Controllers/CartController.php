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
