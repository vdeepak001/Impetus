<?php
$userName = "Palanivel";
$courseNameStr = "Psychiatric Nursing";
$qrData = "Name: $userName\nCourse: $courseNameStr";
$qrUrl = "https://quickchart.io/qr?text=" . urlencode($qrData) . "&size=150";

echo "QR Data: " . $qrData . "\n";
echo "QR URL: " . $qrUrl . "\n";

$content = file_get_contents($qrUrl);
if ($content) {
    file_put_contents("scratch/test_qr.png", $content);
    echo "Saved QR to scratch/test_qr.png\n";
} else {
    echo "Failed to fetch QR\n";
}
