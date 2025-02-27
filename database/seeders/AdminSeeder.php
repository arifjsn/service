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

        $adminUsers = [
            [
                'email' => 'sales@jasanet.co.id',
                'name' => 'Hendra Susanto'
            ],
            [
                'email' => 'arif@jasanet.co.id',
                'name' => 'Arif Febrianto'
            ],
            [
                'email' => 'sales1@jasanet.co.id',
                'name' => 'Erna Safitri'
            ],
            [
                'email' => 'dani@jasanet.co.id',
                'name' => 'Dani Prasetya'
            ],
            [
                'email' => 'iqbal@jasanet.co.id',
                'name' => 'Muhammad Iqbal Ramadan'
            ]
        ];

        foreach ($adminUsers as $adminUserData) {
            $adminUser = User::updateOrCreate([
                'email' => $adminUserData['email']
            ], [
                'name' => $adminUserData['name'],
                'password' => Hash::make('Jasanet@123'),
                'status' => 'active'
            ]);

            $adminUser->assignRole('Admin');
        }
    }
}
