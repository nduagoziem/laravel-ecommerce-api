<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permission::create([
        //     "name" => "manage everything"
        // ]);

        // $super = Role::create([
        //     "name" => "Super Admin"
        // ]);
        // $super->givePermissionTo("manage everything");
    }
}
