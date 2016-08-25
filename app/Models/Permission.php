<?php
namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    public static function getDefaultPermissions() {
        return [
            // Gestion rôles
            'role_index',
            'role_store',
            'role_update',
            'role_editPermission',
            'role_updatePermission',
            'role_destroy',
            // Gestion permissions
            'permission_index',
            'permission_store',
            'permission_update',
            'permission_destroy',
            // Gestion utilisateurs
            'user_index',
            'user_store',
            'user_update',
            'user_destroy',
            // Gestion profil / compte utilisateur
            'user_profile_show',
            'user_profile_update_info',
            'user_profile_update_password',
            'user_profile_destroy',
            'customer_subscribe',
            // Gestion des offres
            'offer_index',
            'offer_store',
            'offer_update',
            'offer_destroy'
        ];
    }
}
