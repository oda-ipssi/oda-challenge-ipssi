<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@ipssi-lyon.com',
            'password' => bcrypt('0000'),
        ]);
        DB::table('users')->insert([
            'name' => 'customer',
            'email' => 'customer@ipssi-lyon.com',
            'password' => bcrypt('0000'),
        ]);
        DB::table('users')->insert([
            'name' => 'registered',
            'email' => 'registered@ipssi-lyon.com',
            'password' => bcrypt('0000'),
        ]);
    }
}
