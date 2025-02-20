<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::updateOrCreate([
            'name' => 'User',
            'guard_name' => 'web'
        ], []);

        $user = User::updateOrCreate([
            'email' => 'user@winkey.id'
        ], [
            'name' => 'User',
            'password' => Hash::make('Winkey@123'),
            'tanggal_lahir' => '2000-01-01',
            'status' => 'active'
        ]);

        $user->assignRole('User');
    }
}
