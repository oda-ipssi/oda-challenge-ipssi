<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'admin',
            'email' => 'admin@ipssi-lyon.com',
            'password' => bcrypt('0000'),
        ]);

        User::create([
            'name' => 'customer',
            'email' => 'customer@ipssi-lyon.com',
            'password' => bcrypt('0000'),
        ]);

        User::create([
            'name' => 'registered',
            'email' => 'registered@ipssi-lyon.com',
            'password' => bcrypt('0000'),
        ]);
    }
}
