<?php
$url = "http://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=test";
$content = @file_get_contents($url);
if ($content) {
    echo "Success: Content length " . strlen($content);
} else {
    echo "Failure: could not fetch content. ";
    $error = error_get_last();
    echo "Error: " . ($error['message'] ?? 'Unknown error');
}
