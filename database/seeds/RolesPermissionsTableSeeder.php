<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class RolesPermissionsTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {

        DB::table('permissions')->delete();
        DB::table('roles')->delete();
        DB::table('permission_role')->delete();
        DB::table('role_user')->delete();

        // ----- Ajout des rôles -----
        // Admin
        $roleAdmin = new Role();
        $roleAdmin->name = 'role_admin';
        $roleAdmin->display_name = 'Admin';
        $roleAdmin->is_deletable = false;
        $roleAdmin->save();
        // Customer
        $roleCustomer = new Role();
        $roleCustomer->name = 'role_customer';
        $roleCustomer->display_name = 'Utilisateur premium (client)';
        $roleCustomer->is_deletable = false;
        $roleCustomer->save();
        // Undercustomer
        $roleUndercustomer = new Role();
        $roleUndercustomer->name = 'role_undercustomer';
        $roleUndercustomer->display_name = 'Webmestre du client';
        $roleUndercustomer->is_deletable = false;
        $roleUndercustomer->save();
        // Registered
        $roleRegistered = new Role();
        $roleRegistered->name = 'role_registered';
        $roleRegistered->display_name = 'Utilisateur';
        $roleRegistered->is_deletable = false;
        $roleRegistered->save();

        // ----- Ajout des permissions -----
        $permissions = [];

        // foreach(Permission::getDefaultPermissions() as $permissionName) {
        //     $permission = new Permission();
        //     $permission->name = $permissionName;
        //     $permission->save();
        //
        //     $permissions[$permissionName] = $permission;
        // }
        //
        // // ----- Assignation des permissions aux rôles -----
        // # ADMIN
        // // Gestion rôles
        // $roleAdmin->attachPermission($permissions['role_index']);
        // $roleAdmin->attachPermission($permissions['role_store']);
        // $roleAdmin->attachPermission($permissions['role_update']);
        // $roleAdmin->attachPermission($permissions['role_updatePermission']);
        // $roleAdmin->attachPermission($permissions['role_destroy']);
        // // Gestion permissions
        // $roleAdmin->attachPermission($permissions['permission_index']);
        // $roleAdmin->attachPermission($permissions['permission_store']);
        // $roleAdmin->attachPermission($permissions['permission_update']);
        // $roleAdmin->attachPermission($permissions['permission_destroy']);
        // // Gestion utilisateurs
        // $roleAdmin->attachPermission($permissions['user_index']);
        // $roleAdmin->attachPermission($permissions['user_store']);
        // $roleAdmin->attachPermission($permissions['user_update']);
        // $roleAdmin->attachPermission($permissions['user_destroy']);
        // // Gestion profil / compte utilisateur
        // $roleAdmin->attachPermission($permissions['user_profile_show']);
        // $roleAdmin->attachPermission($permissions['user_profile_update_info']);
        // $roleAdmin->attachPermission($permissions['user_profile_update_password']);
        // $roleAdmin->attachPermission($permissions['user_profile_destroy']);
        //
        // # REGISTERED
        // // Gestion profil / compte utilisateur
        // $roleRegistered->attachPermission($permissions['user_profile_show']);
        // $roleRegistered->attachPermission($permissions['user_profile_update_info']);
        // $roleRegistered->attachPermission($permissions['user_profile_update_password']);
        // $roleRegistered->attachPermission($permissions['user_profile_destroy']);
        // $roleRegistered->attachPermission($permissions['customer_subscribe']);
        //
        // # CUSTOMER
        // // Gestion des offres
        // $roleCustomer->attachPermission($permissions['offer_index']);
        // $roleCustomer->attachPermission($permissions['offer_store']);
        // $roleCustomer->attachPermission($permissions['offer_update']);
        // $roleCustomer->attachPermission($permissions['offer_destroy']);
        // // Gestion profil / compte utilisateur
        // $roleCustomer->attachPermission($permissions['user_profile_show']);
        // $roleCustomer->attachPermission($permissions['user_profile_update_info']);
        // $roleCustomer->attachPermission($permissions['user_profile_update_password']);
        // $roleCustomer->attachPermission($permissions['user_profile_destroy']);

        // -----Ajout des rôles aux utilisateurs -----

        User::where('username', 'admin')->first()->attachRole($roleAdmin);
        User::where('username', 'customer')->first()->attachRole($roleCustomer);
        User::where('username', 'undercustomer')->first()->attachRole($roleUndercustomer);
        User::where('username', 'undercustomer2')->first()->attachRole($roleUndercustomer);
        User::where('username', 'registered')->first()->attachRole($roleRegistered);
    }
}
