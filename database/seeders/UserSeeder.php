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
            'email' => 'otto@jasanet.co.id'
        ], [
            'name' => 'OTTO Digital',
            'password' => Hash::make('ottodigital'),
            'status' => 'active'
        ]);

        $user->assignRole('User');
    }
}
