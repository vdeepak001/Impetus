<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$searchTerm = 'jam';
$users = User::all();
foreach ($users as $user) {
    $haystack = strtolower($user->name . ' ' . $user->first_name . ' ' . $user->last_name . ' ' . $user->email . ' ' . $user->unique_sequence_number);
    if (strpos($haystack, $searchTerm) !== false) {
        echo $user->id . ': ' . $user->name . ' (' . $user->email . ') UID: ' . $user->unique_sequence_number . "\n";
    }
}
