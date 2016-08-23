<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

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
            'username' => 'admin',
            'firstname' => 'Admin',
            'email' => 'admin@ipssi-lyon.com',
            'password' => bcrypt('0000'),
        ]);

        User::create([
            'username' => 'customer',
            'firstname' => 'Customer',
            'email' => 'customer@ipssi-lyon.com',
            'password' => bcrypt('0000'),
        ]);

        User::create([
            'username' => 'registered',
            'firstname' => 'Registered',
            'email' => 'registered@ipssi-lyon.com',
            'password' => bcrypt('0000'),
        ]);
       factory(App\Models\User::class, 10)->create();
    }
}
