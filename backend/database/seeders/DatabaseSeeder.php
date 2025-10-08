<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'first_name' => 'John',
            'middle_name' => 'Super',
            'last_name' => 'Admin',
            'role' => User::ROLE_ADMIN,
            'email' => 'admin@example.com',
            'password' => Hash::make('adminpassword'),
        ]);

        // Staff Users
        User::create([
            'first_name' => 'Jane',
            'middle_name' => 'Helper',
            'last_name' => 'Staff',
            'role' => User::ROLE_STAFF,
            'email' => 'staff@example.com',
            'password' => Hash::make('staffpassword'),
        ]);

        User::create([
            'first_name' => 'Mike',
            'middle_name' => 'William',
            'last_name' => 'Support',
            'role' => User::ROLE_STAFF,
            'email' => 'support@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Client User (default role)
        User::create([
            'first_name' => 'Client',
            'middle_name' => null,
            'last_name' => 'User',
            'role' => User::ROLE_CLIENT,
            'email' => 'client@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Additional sample users with varied names
        $sampleUsers = [
            ['Maria', 'Santos', 'Garcia', 'maria.garcia@example.com', User::ROLE_CLIENT],
            ['Robert', 'James', 'Johnson', 'robert.johnson@example.com', User::ROLE_CLIENT],
            ['Emily', null, 'Davis', 'emily.davis@example.com', User::ROLE_CLIENT],
            ['Michael', 'Anthony', 'Wilson', 'michael.wilson@example.com', User::ROLE_STAFF],
            ['Sarah', 'Elizabeth', 'Brown', 'sarah.brown@example.com', User::ROLE_CLIENT],
            ['David', null, 'Miller', 'david.miller@example.com', User::ROLE_CLIENT],
            ['Lisa', 'Marie', 'Anderson', 'lisa.anderson@example.com', User::ROLE_CLIENT],
            ['James', 'Thomas', 'Taylor', 'james.taylor@example.com', User::ROLE_CLIENT],
            ['Jennifer', null, 'Martinez', 'jennifer.martinez@example.com', User::ROLE_CLIENT],
            ['Christopher', 'Lee', 'White', 'chris.white@example.com', User::ROLE_CLIENT],
        ];

        foreach ($sampleUsers as [$firstName, $middleName, $lastName, $email, $role]) {
            User::create([
                'first_name' => $firstName,
                'middle_name' => $middleName,
                'last_name' => $lastName,
                'role' => $role,
                'email' => $email,
                'password' => Hash::make('password123'),
            ]);
        }
    }
}
