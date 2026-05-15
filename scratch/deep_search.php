<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Order;
use App\Models\User;

$searchTerm = 'jam';

echo "Searching Users...\n";
foreach (User::all() as $u) {
    $fields = ['name', 'first_name', 'last_name', 'email', 'unique_sequence_number'];
    foreach ($fields as $f) {
        $val = strtolower((string)$u->$f);
        if (strpos($val, $searchTerm) !== false) {
            echo "User {$u->id} matches in {$f}: {$val}\n";
            break;
        }
    }
}

echo "\nSearching Orders...\n";
foreach (Order::with(['courseDetail', 'stateCouncil.state'])->get() as $o) {
    $matches = [];
    if (strpos(strtolower($o->remarks), $searchTerm) !== false) $matches[] = 'remarks';
    if ($o->courseDetail && strpos(strtolower($o->courseDetail->couse_name), $searchTerm) !== false) $matches[] = 'course_name';
    if ($o->stateCouncil && strpos(strtolower($o->stateCouncil->council_name), $searchTerm) !== false) $matches[] = 'council_name';
    if ($o->stateCouncil && $o->stateCouncil->state && strpos(strtolower($o->stateCouncil->state->name), $searchTerm) !== false) $matches[] = 'state_name';
    
    if (!empty($matches)) {
        echo "Order {$o->id} (User: {$o->user_id}) matches in: " . implode(', ', $matches) . "\n";
    }
}
