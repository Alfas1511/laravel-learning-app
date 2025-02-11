<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Parent Permissions
        $parentPermissions = [
            [
                'name' => 'users',
                'guard_name' => 'web',
            ],
            [
                'name' => 'branches',
                'guard_name' => 'web',
            ],
        ];
        $parentIds = [];
        foreach ($parentPermissions as $permission) {
            $createdPermission = Permission::create([
                'name' => $permission['name'],
                'guard_name' => $permission['guard_name'],
                'is_parent' => 1,
            ]);
            $parentIds[$permission['name']] = $createdPermission->id;
        }

        // Child Permissions
        $childPermissions = [
            ['name' => 'create-user', 'parent' => 'users'],
            ['name' => 'view-user', 'parent' => 'users'],
            ['name' => 'edit-user', 'parent' => 'users'],
            ['name' => 'delete-user', 'parent' => 'users'],
            ['name' => 'create-branch', 'parent' => 'branches'],
            ['name' => 'view-branch', 'parent' => 'branches'],
            ['name' => 'edit-branch', 'parent' => 'branches'],
            ['name' => 'delete-branch', 'parent' => 'branches'],
        ];
        // Insert Child Permissions
        foreach ($childPermissions as $permission) {
            Permission::create([
                'name' => $permission['name'],
                'guard_name' => 'web',
                'is_parent' => 0,
                'parent_id' => $parentIds[$permission['parent']],
            ]);
        }
    }
}
