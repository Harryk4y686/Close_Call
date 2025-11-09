<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create
                            {email? : The email address of the admin}
                            {--password= : The password for the admin account}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user account';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating Admin User...');
        $this->newLine();

        // Get email
        $email = $this->argument('email') ?? $this->ask('Enter admin email address');

        // Check if user already exists
        if (User::where('email', $email)->exists()) {
            $this->error('A user with this email already exists!');
            
            if ($this->confirm('Do you want to make this user an admin?')) {
                $user = User::where('email', $email)->first();
                $user->is_admin = true;
                $user->save();
                
                $this->info('User has been granted admin access!');
                $this->displayUserInfo($user);
                return Command::SUCCESS;
            }
            
            return Command::FAILURE;
        }

        // Get password
        $password = $this->option('password') ?? $this->secret('Enter admin password (min 8 characters)');
        
        if (strlen($password) < 8) {
            $this->error('Password must be at least 8 characters!');
            return Command::FAILURE;
        }

        // Get name
        $name = $this->ask('Enter admin name', 'Admin');
        
        // Create admin user
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => true,
        ]);

        $this->newLine();
        $this->info('✓ Admin user created successfully!');
        $this->newLine();
        $this->displayUserInfo($user);

        return Command::SUCCESS;
    }

    /**
     * Display user information
     */
    private function displayUserInfo($user)
    {
        $this->table(
            ['Field', 'Value'],
            [
                ['ID', $user->id],
                ['Name', $user->name],
                ['Email', $user->email],
                ['Admin', $user->is_admin ? 'Yes' : 'No'],
                ['Created', $user->created_at->format('Y-m-d H:i:s')],
            ]
        );
        
        $this->newLine();
        $this->info('You can now login at: ' . url('/login'));
        $this->info('Admin dashboard: ' . url('/admin/dashboard'));
    }
}
