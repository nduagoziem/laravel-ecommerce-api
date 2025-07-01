<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $user = User::firstOrCreate(
        //     ['email' => 'super@example.com'],
        //     ['name' => 'Super Admin', 'password' => bcrypt('password')]
        // );

        // $user->assignRole('Super Admin');
    }
}
