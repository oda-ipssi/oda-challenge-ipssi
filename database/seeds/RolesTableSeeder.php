<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->delete();

        $adminRole = new Role;
        $adminRole->name = 'role_admin';
        $adminRole->display_name = 'Administrateur';
        $adminRole->description = 'Rôle administrateur impossible à supprimer';
        $adminRole->is_deletabled = false;
        $adminRole->save();

        $custRole = new Role;
        $custRole->name = 'role_customer';
        $custRole->display_name = 'Customer';
        $custRole->description = 'Rôle customer impossible à supprimer';
        $custRole->is_deletabled = false;
        $custRole->save();

        $regRole = new Role;
        $regRole->name = 'role_registered';
        $regRole->display_name = 'Registered';
        $regRole->description = 'Rôle register impossible à supprimer';
        $regRole->is_deletabled = false;
        $regRole->save();

        $user = User::where('name','=','admin')->first();
        $user->attachRole($adminRole);

        $user = User::where('name','=','customer')->first();
        $user->attachRole($custRole);

        $user = User::where('name','=','registered')->first();
        $user->attachRole($regRole);

    }
}
