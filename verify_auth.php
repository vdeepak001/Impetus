<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Verifying Roles...\n";
$roles = ['super admin', 'admin', 'SME', 'customer support'];
foreach ($roles as $roleName) {
    if (Role::where('name', $roleName)->exists()) {
        echo "✅ Role '$roleName' exists.\n";
    } else {
        echo "❌ Role '$roleName' MISSING.\n";
    }
}

echo "\nTesting User Encryption and Role Assignment...\n";
$email = 'test_user@example.com';
$name = 'Secret User';
$password = 'password123';

// Cleanup if exists
User::where('email', $email)->delete();

$user = User::create([
    'name' => $name,
    'email' => $email,
    'password' => Hash::make($password),
]);

echo "✅ User created.\n";

// Verify encryption in DB
$raw = DB::table('users')->where('email', $email)->first();
if ($raw->name !== $name && str_contains($raw->name, 'eyJpdiI6')) {
    echo "✅ Name is encrypted in the database.\n";
} else {
    echo "❌ Name is NOT encrypted (Value in DB: " . $raw->name . ")\n";
}

// Verify decryption in Model
if ($user->name === $name) {
    echo "✅ Name correctly decrypted in User model.\n";
} else {
    echo "❌ Name decryption FAILED.\n";
}

// Verify Role Assignment
$user->assignRole('admin');
if ($user->hasRole('admin')) {
    echo "✅ Role 'admin' successfully assigned and verified.\n";
} else {
    echo "❌ Role assignment FAILED.\n";
}

// Verify Login Simulation (Check if user can be found by email)
$foundUser = User::where('email', $email)->first();
if ($foundUser && Hash::check($password, $foundUser->password)) {
    echo "✅ Login simulation successful (User found by email and password verified).\n";
} else {
    echo "❌ Login simulation FAILED.\n";
}

// Final Cleanup
// $user->delete();
echo "\nVerification complete.\n";
