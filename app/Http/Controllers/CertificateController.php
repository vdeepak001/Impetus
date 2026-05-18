<?php

namespace App\Http\Controllers;

use App\Models\CourseDetail;
use App\Models\CourseTestAttempt;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function download(Request $request, $orderId)
    {
        ini_set('memory_limit', '256M');
        $order = Order::with(['courseDetail', 'user', 'stateCouncil'])->findOrFail($orderId);

        // Ensure the order belongs to the authenticated user OR user is an admin/staff
        $authUser = Auth::user();
        if ($authUser->role_type === 'user' && $order->user_id !== $authUser->id) {
            abort(403);
        }

        // Fetch completion details
        $completion = CourseTestAttempt::query()
            ->where('user_id', $order->user_id)
            ->where('course_detail_id', $order->course_detail_id)
            ->where('test_type', \App\Enums\CourseTestType::Final)
            ->where('status', CourseTestAttempt::STATUS_COMPLETED)
            ->where('passed', true)
            ->latest('completed_at')
            ->first();

        if (!$completion) {
            return back()->with('error', 'You have not completed this course yet.');
        }

        $points = 0;
        if ($order->state_council_id) {
            $pivot = \Illuminate\Support\Facades\DB::table('course_detail_state_council')
                ->where('course_detail_id', $order->course_detail_id)
                ->where('state_council_id', $order->state_council_id)
                ->first();
            if ($pivot) {
                $p = json_decode($pivot->points, true);
                $points = is_array($p) ? ($p[0] ?? 0) : ($p ?? 0);
            }
        }

        $data = [
            'order' => $order,
            'completion' => $completion,
            'user' => $order->user,
            'course' => $order->courseDetail,
            'date' => $completion->completed_at->format('d F, Y'),
            'points' => (int) $points,
        ];

        $pdf = app('dompdf.wrapper')->loadView('certificates.standard', $data);
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('Certificate-' . ($order->courseDetail->course_code ?? 'CNE') . '.pdf');
    }
}
