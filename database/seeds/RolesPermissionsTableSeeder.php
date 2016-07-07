<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\User;

class RolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ----- Ajout des rôles -----

        // Admin
        $roleAdmin = new Role();
        $roleAdmin->name = 'role_admin';
        $roleAdmin->display_name = 'Admin';
        $roleAdmin->save();

        // Registered
        $roleRegistered = new Role();
        $roleRegistered->name = 'role_registered';
        $roleRegistered->display_name = 'Utilisateur';
        $roleRegistered->save();

        // Customer
        $roleCustomer = new Role();
        $roleCustomer->name = 'role_customer';
        $roleCustomer->display_name = 'Utilisateur premium (client)';
        $roleCustomer->save();

        // ----- Ajout des permissions -----

        $permissions = [];

        foreach(Permission::getDefaultPermissions() as $permissionName) {
            $permission = new Permission();
            $permission->name = $permissionName;
            $permission->save();

            $permissions[$permissionName] = $permission;
        }

        // ----- Assignation des permissions aux rôles -----

        # ADMIN

        // Gestion rôles
        $roleAdmin->attachPermission($permissions['role_index']);
        $roleAdmin->attachPermission($permissions['role_create']);
        $roleAdmin->attachPermission($permissions['role_edit']);
        $roleAdmin->attachPermission($permissions['role_destroy']);
        $roleAdmin->attachPermission($permissions['role_store']);
        // Gestion permissions
        $roleAdmin->attachPermission($permissions['permission_index']);
        $roleAdmin->attachPermission($permissions['permission_create']);
        $roleAdmin->attachPermission($permissions['permission_edit']);
        $roleAdmin->attachPermission($permissions['permission_destroy']);
        $roleAdmin->attachPermission($permissions['permission_store']);
        // Gestion utilisateurs
        $roleAdmin->attachPermission($permissions['user_index']);
        $roleAdmin->attachPermission($permissions['user_show']);
        $roleAdmin->attachPermission($permissions['user_create']);
        $roleAdmin->attachPermission($permissions['user_edit']);
        $roleAdmin->attachPermission($permissions['user_destroy']);
        $roleAdmin->attachPermission($permissions['user_store']);
        // Gestion profil / compte utilisateur
        $roleAdmin->attachPermission($permissions['user_profile_show']);
        $roleAdmin->attachPermission($permissions['user_profile_update_info']);
        $roleAdmin->attachPermission($permissions['user_profile_update_password']);
        $roleAdmin->attachPermission($permissions['user_profile_destroy']);

        # REGISTERED

        // Gestion profil / compte utilisateur
        $roleRegistered->attachPermission($permissions['user_profile_show']);
        $roleRegistered->attachPermission($permissions['user_profile_update_info']);
        $roleRegistered->attachPermission($permissions['user_profile_update_password']);
        $roleRegistered->attachPermission($permissions['user_profile_delete']);
        $roleRegistered->attachPermission($permissions['customer_subscribe']);

        # CUSTOMER

        // Gestion des offres
        $roleCustomer->attachPermission($permissions['offer_show']);
        $roleCustomer->attachPermission($permissions['offer_create']);
        $roleCustomer->attachPermission($permissions['offer_edit']);
        $roleCustomer->attachPermission($permissions['offer_destroy']);
        $roleCustomer->attachPermission($permissions['offer_store']);
        // Gestion profil / compte utilisateur
        $roleCustomer->attachPermission($permissions['user_profile_show']);
        $roleCustomer->attachPermission($permissions['user_profile_update_info']);
        $roleCustomer->attachPermission($permissions['user_profile_update_password']);
        $roleCustomer->attachPermission($permissions['user_profile_delete']);

        // -----Ajout des rôles aux utilisateurs -----

        User::where('name', 'admin')->first()->attachRole($roleAdmin);
        User::where('name', 'customer')->first()->attachRole($roleCustomer); // DEV
        User::where('name', 'registered')->first()->attachRole($roleRegistered); // DEV
    }
}
