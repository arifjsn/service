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
            'email' => 'sales@jasanet.co.id'
        ], [
            'name' => 'Hendra Susanto',
            'password' => Hash::make('Jasanet@123'),
            'status' => 'active'
        ]);
        $adminUser = User::updateOrCreate([
            'email' => 'arif@jasanet.co.id'
        ], [
            'name' => 'Arif Febrianto',
            'password' => Hash::make('Jasanet@123'),
            'status' => 'active'
        ]);
        $adminUser = User::updateOrCreate([
            'email' => 'sales1@jasanet.co.id'
        ], [
            'name' => 'Erna Safitri',
            'password' => Hash::make('Jasanet@123'),
            'status' => 'active'
        ]);
        $adminUser = User::updateOrCreate([
            'email' => 'dani@jasanet.co.id'
        ], [
            'name' => 'Dani Prasetya',
            'password' => Hash::make('Jasanet@123'),
            'status' => 'active'
        ]);
        $adminUser = User::updateOrCreate([
            'email' => 'iqbal@jasanet.co.id'
        ], [
            'name' => 'Muhammad Iqbal Ramadan',
            'password' => Hash::make('Jasanet@123'),
            'status' => 'active'
        ]);

        $adminUser->assignRole('Admin');
    }
}
