<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

echo "--- User Data Debug ---\n";
foreach (User::where('role_type', 'user')->get() as $u) {
    echo "ID: {$u->id}\n";
    echo "Name: '{$u->name}'\n";
    echo "First Name: '{$u->first_name}'\n";
    echo "Last Name: '{$u->last_name}'\n";
    echo "UID: '{$u->unique_sequence_number}'\n";
    echo "Email: '{$u->email}'\n";
    echo "-----------------------\n";
}
