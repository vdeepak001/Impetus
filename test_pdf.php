<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '256M');
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Models\CourseDetail;
use App\Models\CourseTestAttempt;
use App\Models\Order;

$user = new User();
$user->name = "John Doe";
$user->gender = "male";
$user->unique_sequence_number = "USN-12345";
$user->state = "Delhi";

$course = new CourseDetail();
$course->couse_name = "Advanced Pediatric Resuscitation & Nursing Management";
$course->course_code = "CNE-PED-04";

$completion = new CourseTestAttempt();
$completion->completed_at = now();

$order = new Order();
$order->user = $user;
$order->courseDetail = $course;
$order->user_id = 999;
$order->course_detail_id = 999;

$points = 4;
$date = $completion->completed_at->format('d F, Y');

$data = [
    'order' => $order,
    'completion' => $completion,
    'user' => $user,
    'course' => $course,
    'date' => $date,
    'points' => $points,
];

try {
    $pdf = app('dompdf.wrapper')->loadView('certificates.standard', $data);
    $pdf->setPaper('A4', 'landscape');
    $pdf->save(public_path('test-cert.pdf'));
    echo "SUCCESS: PDF generated successfully at " . public_path('test-cert.pdf') . "\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n";
}
