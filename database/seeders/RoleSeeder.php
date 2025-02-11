<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $roles = [
            [
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'teacher',
                'guard_name' => 'web',
            ],
            [
                'name' => 'user',
                'guard_name' => 'web',
            ],
        ];

        foreach ($roles as $roleData) {
            Role::create($roleData);
        }
    }
}
