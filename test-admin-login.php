<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "Testing Admin Account\n";
echo "=====================\n\n";

$user = User::where('email', 'admin@gmail.com')->first();

if (!$user) {
    echo "❌ User not found!\n";
    exit(1);
}

echo "✓ User found: {$user->email}\n";
echo "  ID: {$user->id}\n";
echo "  Name: {$user->name}\n";
echo "  Is Admin: " . ($user->is_admin ? 'YES' : 'NO') . "\n";
echo "  Has Password: " . (!empty($user->password) ? 'YES' : 'NO') . "\n\n";

echo "Testing password: admin12345\n";
if (Hash::check('admin12345', $user->password)) {
    echo "✓ Password matches!\n";
} else {
    echo "❌ Password does NOT match!\n";
    echo "\nFixing password...\n";
    $user->password = Hash::make('admin12345');
    $user->save();
    echo "✓ Password updated!\n";
}

echo "\n";
echo "Login Credentials:\n";
echo "==================\n";
echo "Email: admin@gmail.com\n";
echo "Password: admin12345\n";
