<?php
namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    public static function getDefaultPermissions() {
        return [
            // Gestion rôles
            'role_index',
            'role_show',
            'role_create',
            'role_update',
            'role_delete',
            'role_store',
            // Gestion permissions
            'permission_index',
            'permission_show',
            'permission_create',
            'permission_update',
            'permission_delete',
            'permission_store',
            // Gestion utilisateurs
            'user_index',
            'user_show',
            'user_create',
            'user_update',
            'user_delete',
            'user_store',
            // Gestion profil / compte utilisateur
            'user_profile_show',
            'user_profile_update_info',
            'user_profile_update_password',
            'user_profile_delete',
            'customer_subscribe',
            // Gestion des offres
            'offer_show',
            'offer_create',
            'offer_update',
            'offer_delete',
            'offer_store'
        ];
    }
}
