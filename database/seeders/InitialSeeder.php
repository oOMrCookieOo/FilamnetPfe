<?php

namespace Database\Seeders;

use http\Client\Curl\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::query()->create([
            'name' => 'Isslem Maali',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $role = Role::query()->create([
            'name' => 'super_admin',
        ]);

        $perms = [
            "create_brand",
            "create_category",
            "create_customer",
            "create_discount",
            "create_order",
            "create_product",
            "create_role",
            "create_user",
            "delete_any_brand",
            "delete_any_category",
            "delete_any_customer",
            "delete_any_discount",
            "delete_any_order",
            "delete_any_product",
            "delete_any_role",
            "delete_any_user",
            "delete_brand",
            "delete_category",
            "delete_customer",
            "delete_discount",
            "delete_order",
            "delete_product",
            "delete_role",
            "delete_user",
            "export_brand",
            "export_category",
            "export_customer",
            "export_discount",
            "export_order",
            "export_product",
            "export_role",
            "export_user",
            "update_brand",
            "update_category",
            "update_customer",
            "update_discount",
            "update_order",
            "update_product",
            "update_role",
            "update_user",
            "view_any_brand",
            "view_any_category",
            "view_any_customer",
            "view_any_discount",
            "view_any_order",
            "view_any_product",
            "view_any_role",
            "view_any_user",
            "view_brand",
            "view_category",
            "view_customer",
            "view_discount",
            "view_order",
            "view_product",
            "view_role",
            "view_user",
        ];
        $perms_ids = [];
        foreach ($perms as $perm) {
            $p = Permission::query()->create([
                'name' => $perm
            ]);
            $perms_ids[] = $p->id;
        }

        $role->givePermissionTo($perms_ids);
        $user->assignRole($role);
    }
}
