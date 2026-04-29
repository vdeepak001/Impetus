<?php

namespace App\Http\Controllers;

use App\Models\CourseDetail;
use App\Models\CourseTestAttempt;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function download(Request $request, $orderId)
    {
        $order = Order::with(['courseDetail', 'user'])->findOrFail($orderId);

        // Ensure the order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
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

        $pdf = Pdf::loadView('certificates.standard', $data);
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('Certificate-' . ($order->courseDetail->course_code ?? 'CNE') . '.pdf');
    }
}
