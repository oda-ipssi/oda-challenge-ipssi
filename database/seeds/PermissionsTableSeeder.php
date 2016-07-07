<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();

        $permissions = array(
            array( // 1
                'name'         => 'role_index',
                'display_name' => 'Role index',
                'is_deletabled' => false
            ),
            array( // 2
                'name'         => 'role_create',
                'display_name' => 'Role create',
                'is_deletabled' => false
            ),
            array( // 3
                'name'         => 'role_store',
                'display_name' => 'Role store',
                'is_deletabled' => false
            ),
            array( // 4
                'name'         => 'role_show',
                'display_name' => 'Role show',
                'is_deletabled' => false
            ),
            array( // 5
                'name'         => 'role_edit',
                'display_name' => 'Role edit',
                'is_deletabled' => false
            ),
            array( // 6
                'name'         => 'role_update',
                'display_name' => 'Role update',
                'is_deletabled' => false
            ),
            array( // 7
                'name'         => 'role_destroy',
                'display_name' => 'Role destroy',
                'is_deletabled' => false
            ),
        );

        DB::table('permissions')->insert($permissions);

        DB::table('permission_role')->delete();

        $role_id_admin = Role::where('name', '=', 'admin')->first()->id;
        $role_id_cust = Role::where('name', '=', 'customer')->first()->id;
        $role_id_reg = Role::where('name', '=', 'registered')->first()->id;

        $permission_base = (int)DB::table('permissions')->first()->id - 1;

        $permissions = array(
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 1
            ),
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 2
            ),
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 3
            ),
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 4
            ),
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 5
            ),
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 6
            ),
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 7
            ),
        );

        DB::table('permission_role')->insert($permissions);

    }
}
