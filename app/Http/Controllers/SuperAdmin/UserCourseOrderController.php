<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Enums\PaymentMode;
use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserCourseOrderRequest;
use App\Models\CourseDetail;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserCourseOrderController extends Controller
{
    /**
     * Active modules available to the learner (same state filter as the public CPD listing).
     */
    public function courses(Request $request, int $userId): JsonResponse
    {
        $user = User::query()->findOrFail($userId);

        abort_unless($user->role_type === 'user', 404);

        $query = CourseDetail::query()
            ->where('active_status', 1);

        if (filled($user->state)) {
            $stateName = trim((string) $user->state);
            $query->whereHas('stateCouncils', function ($stateCouncilQuery) use ($stateName) {
                $stateCouncilQuery
                    ->where('active_status', true)
                    ->whereHas('state', function ($stateQuery) use ($stateName) {
                        $stateQuery->where('name', $stateName)->where('status', 'active');
                    });
            });
        }

        $courses = $query
            ->orderByRaw('CASE WHEN sequence IS NULL THEN 1 ELSE 0 END')
            ->orderBy('sequence')
            ->orderBy('id')
            ->get(['id', 'couse_name']);

        $modes = collect(PaymentMode::cases())->map(fn (PaymentMode $mode) => [
            'value' => $mode->value,
            'label' => $mode->label(),
        ])->values();

        return response()->json([
            'courses' => $courses->map(fn (CourseDetail $c) => [
                'id' => $c->id,
                'name' => $c->couse_name,
            ]),
            'payment_modes' => $modes,
            'message' => $courses->isEmpty() && filled($user->state)
                ? 'No modules are linked to this learner’s state.'
                : ($courses->isEmpty() ? 'No active modules are available.' : null),
        ]);
    }

    public function store(StoreUserCourseOrderRequest $request, int $userId): JsonResponse|RedirectResponse
    {
        $user = User::query()->findOrFail($userId);

        abort_unless($user->role_type === 'user', 404);

        $course = CourseDetail::query()->findOrFail((int) $request->validated('course_detail_id'));

        abort_unless((int) $course->active_status === 1, 422);

        $stateCouncil = null;

        if (filled($user->state)) {
            $stateName = trim((string) $user->state);
            $stateCouncil = $course->stateCouncils()
                ->where('active_status', true)
                ->whereHas('state', function ($stateQuery) use ($stateName) {
                    $stateQuery->where('name', $stateName)->where('status', 'active');
                })
                ->first();

            abort_unless($stateCouncil !== null, 422);
        }

        $validated = $request->validated();

        $paymentStatus = isset($validated['payment_status'])
            ? PaymentStatus::from($validated['payment_status'])
            : PaymentStatus::Completed;

        Order::query()->create([
            'user_id' => $user->id,
            'course_detail_id' => $course->id,
            'state_council_id' => $stateCouncil?->id,
            'payment_mode' => $validated['payment_mode'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'remarks' => $validated['remarks'] ?? null,
            'payment_status' => $paymentStatus,
            'recorded_by_id' => $request->user()?->id,
        ]);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Order recorded successfully.']);
        }

        return redirect()->back()->with('success', 'Order recorded successfully.');
    }
}
