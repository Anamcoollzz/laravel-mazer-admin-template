<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Seed default application users and assign Spatie roles.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => 'password',
                'role' => 'super-admin',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => 'password',
                'role' => 'admin',
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'password' => 'password',
                'role' => 'user',
            ],
        ];

        foreach ($users as $data) {
            $user = User::query()->firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => $data['password'],
                    'email_verified_at' => now(),
                ],
            );

            if (Role::query()->where('name', $data['role'])->exists()) {
                $user->syncRoles([$data['role']]);
            }
        }
    }
}
