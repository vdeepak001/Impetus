<?php
$url = "https://quickchart.io/qr?text=test&size=150";
$content = @file_get_contents($url);
if ($content) {
    echo "Success: Content length " . strlen($content);
} else {
    echo "Failure: could not fetch content. ";
    $error = error_get_last();
    echo "Error: " . ($error['message'] ?? 'Unknown error');
}
