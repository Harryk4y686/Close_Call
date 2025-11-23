<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AdminUser;
use Illuminate\Support\Facades\DB;

class TestDatabaseInsert extends Command
{
    protected $signature = 'test:insert';
    protected $description = 'Test inserting a user directly into database';

    public function handle()
    {
        $this->info('Database: ' . DB::connection()->getDatabaseName());
        $this->info('Current user count: ' . AdminUser::count());
        
        try {
            $user = AdminUser::create([
                'first_name' => 'Test',
                'last_name' => 'User',
                'email' => 'test' . time() . '@example.com',
                'phone_number' => '1234567890',
                'date_of_birth' => '2000-01-01',
                'location' => 'Test City',
                'postal_code' => '12345',
            ]);
            
            $this->info('SUCCESS! User created with ID: ' . $user->id);
            $this->info('New user count: ' . AdminUser::count());
            
            return 0;
        } catch (\Exception $e) {
            $this->error('ERROR: ' . $e->getMessage());
            return 1;
        }
    }
}
