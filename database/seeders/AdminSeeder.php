<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::updateOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web'
        ], []);

        $adminUser = User::updateOrCreate([
            'email' => 'warranty@winkey.id'
        ], [
            'name' => 'Admin',
            'password' => Hash::make('Winkey@123'),
            'tanggal_lahir' => '2000-01-01',
            'status' => 'active'
        ]);

        $adminUser->assignRole('Admin');
    }
}
