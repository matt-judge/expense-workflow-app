<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creates a standard and admin user
        $this->createUser('Employee User', 'employee@test.com', 'employee', 'password123');
        $this->createUser('Admin User', 'admin@test.com', 'admin', 'password123');
    }

    /**
     * Create a user with the given details.
     */
    private function createUser(string $name, string $email, string $role, string $password): void
    {
        User::factory()->create([
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'password' => Hash::make($password)
        ]);
    }
}
