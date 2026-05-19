<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Enums\PaymentMode;
use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserCourseOrderRequest;
use App\Enums\CourseTestType;
use App\Models\CourseTestAttempt;
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

        $stateName = null;
        if (filled($user->state)) {
            $stateName = trim((string) $user->state);
            $query->whereHas('stateCouncils', function ($stateCouncilQuery) use ($stateName) {
                $stateCouncilQuery
                    ->where('active_status', true)
                    ->whereHas('state', function ($stateQuery) use ($stateName) {
                        $stateQuery->where('name', $stateName)->where('status', 'active');
                    });
            })->with(['stateCouncils' => function ($stateCouncilQuery) use ($stateName) {
                $stateCouncilQuery
                    ->where('active_status', true)
                    ->whereHas('state', function ($stateQuery) use ($stateName) {
                        $stateQuery->where('name', $stateName)->where('status', 'active');
                    });
            }]);
        }

        $courses = $query
            ->orderByRaw('CASE WHEN sequence IS NULL THEN 1 ELSE 0 END')
            ->orderBy('sequence')
            ->orderBy('id')
            ->get();

        $modes = collect(PaymentMode::cases())->map(fn (PaymentMode $mode) => [
            'value' => $mode->value,
            'label' => $mode->label(),
        ])->values();

        return response()->json([
            'courses' => $courses->map(function (CourseDetail $c) use ($user) {
                $validDays = 0;
                $sc = $c->stateCouncils->first();
                if ($sc && $sc->pivot) {
                    $val = $sc->pivot->valid_days;
                    $validDays = is_array($val) ? ($val[0] ?? 0) : ($val ?? 0);
                }

                $latestOrder = Order::query()
                    ->where('user_id', $user->id)
                    ->where('course_detail_id', $c->id)
                    ->where('payment_status', \App\Enums\PaymentStatus::Completed)
                    ->latest('id')
                    ->first();

                $finalAttempts = CourseTestAttempt::query()
                    ->where('user_id', $user->id)
                    ->where('course_detail_id', $c->id)
                    ->where('test_type', CourseTestType::Final->value)
                    ->where('status', CourseTestAttempt::STATUS_COMPLETED)
                    ->when($latestOrder, fn($q) => $q->where('started_at', '>=', $latestOrder->created_at))
                    ->get();

                $isFailed = $finalAttempts->count() >= 2 && ! $finalAttempts->contains('passed', true);

                return [
                    'id' => $c->id,
                    'name' => $c->couse_name,
                    'valid_days' => (int) $validDays,
                    'is_failed' => $isFailed,
                ];
            }),
            'payment_modes' => $modes,
            'message' => $courses->isEmpty() && filled($user->state)
                ? 'No modules are linked to this learner’s state.'
                : ($courses->isEmpty() ? 'No active modules are available.' : null),
        ]);
    }

    public function purchasedCourses(int $userId): JsonResponse
    {
        $user = User::query()->findOrFail($userId);
        abort_unless($user->role_type === 'user', 404);

        $allOrders = Order::query()
            ->with('courseDetail:id,couse_name')
            ->where('user_id', $user->id)
            ->where('payment_status', PaymentStatus::Completed)
            ->latest('id')
            ->get();

        $orders = $allOrders->map(function ($order, $index) use ($allOrders) {
            // Because we sorted by latest('id'), any order at index < $index is NEWER.
            // We want to find the "next" order for the same course to set an upper bound.
            $nextOrder = $allOrders->slice(0, $index)->firstWhere('course_detail_id', $order->course_detail_id);

            $baseQuery = CourseTestAttempt::query()
                ->where('user_id', $order->user_id)
                ->where('course_detail_id', $order->course_detail_id)
                ->where('status', CourseTestAttempt::STATUS_COMPLETED)
                ->where('started_at', '>=', $order->created_at);

            if ($nextOrder) {
                $baseQuery->where('started_at', '<', $nextOrder->created_at);
            }

            $pre = (clone $baseQuery)
                ->where('test_type', \App\Enums\CourseTestType::Pre->value)
                ->latest('completed_at')
                ->first();

            $mock = (clone $baseQuery)
                ->where('test_type', \App\Enums\CourseTestType::Mock->value)
                ->latest('completed_at')
                ->first();

            $completion = (clone $baseQuery)
                ->where('test_type', \App\Enums\CourseTestType::Final->value)
                ->orderByDesc('passed')
                ->latest('completed_at')
                ->first();

                return [
                    'id' => $order->id,
                    'course_id' => $order->course_detail_id,
                    'course_name' => $order->courseDetail?->couse_name ?? 'N/A',
                    'purchase_date' => $order->start_date ? $order->start_date->format('d-m-Y') : '-',
                    'expiry_date' => $order->end_date ? $order->end_date->format('d-m-Y') : '-',
                    'completion_date' => $completion ? $completion->completed_at->format('d-m-Y') : '-',
                    'passed' => $completion ? (bool) $completion->passed : false,
                    'scores' => [
                        'pre' => $pre ? (float) $pre->score_percent : 0,
                        'mock' => $mock ? (float) $mock->score_percent : 0,
                        'final' => $completion ? (float) $completion->score_percent : 0,
                    ]
                ];
            });

        return response()->json([
            'orders' => $orders,
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

        $order = Order::query()->create([
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

        if ($paymentStatus === PaymentStatus::Completed) {
            try {
                \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\ModuleActivationMail($user, $course, $order));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Failed to send module activation mail: ' . $e->getMessage());
            }
        }

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Order recorded successfully.']);
        }

        return redirect()->back()->with('success', 'Order recorded successfully.');
    }
}
