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
        // ----- ADMIN -----
        User::create([
            'username' => 'admin',
            'email' =>  'admin@example.net',
            'password' => bcrypt('oda'),
            'firstname' => 'admin',
            'lastname' => 'testAdmin',
            'address' => 'Rue Admin',
            'zipcode' => '77777',
            'city' => 'AdminCity',
            'phone' => '0102030405',
            'ip' => '87842564',
            'is_prospect' => 0,
            'is_active' => 1,
        ]);
        // ----- CUSTOMER -----
        User::create([
            'username' => 'customer',
            'email' =>  'customer@example.net',
            'password' => bcrypt('oda'),
            'firstname' => 'customer',
            'lastname' => 'testCustomer',
            'address' => 'Rue Customer',
            'zipcode' => '77777',
            'city' => 'CustomerCity',
            'phone' => '0102030405',
            'ip' => '87842564',
            'is_prospect' => 0,
            'is_active' => 1,
        ]);
        // ----- UNDERCUSTOMER -----
        User::create([
            'username' => 'undercustomer',
            'email' =>  'undercustomer@example.net',
            'password' => bcrypt('oda'),
            'firstname' => 'undercustomer',
            'lastname' => 'testUndercustomer',
            'address' => 'Rue Undercustomer',
            'zipcode' => '77777',
            'city' => 'UndercustomerCity',
            'phone' => '0102030405',
            'ip' => '87842564',
            'is_prospect' => 0,
            'id_customer' => 2,
            'is_active' => 1,
        ]);
        // ----- UNDERCUSTOMER -----
        User::create([
            'username' => 'undercustomer2',
            'email' =>  'undercustomer2@example.net',
            'password' => bcrypt('oda'),
            'firstname' => 'undercustomer2',
            'lastname' => 'testUndercustomer2',
            'address' => 'Rue Undercustomer2',
            'zipcode' => '77777',
            'city' => 'UndercustomerCity2',
            'phone' => '0102030405',
            'ip' => '87842564',
            'is_prospect' => 0,
            'id_customer' => 2,
            'is_active' => 1,
        ]);
        // ----- REGISTERED -----
        User::create([
            'username' => 'registered',
            'email' =>  'registered@example.net',
            'password' => bcrypt('oda'),
            'firstname' => 'registered',
            'lastname' => 'testRegistered',
            'address' => 'Rue Registered',
            'zipcode' => '77777',
            'city' => 'RegisteredCity',
            'phone' => '0102030405',
            'ip' => '87842564',
            'is_prospect' => 1,
            'is_active' => 0,
        ]);

//       factory(App\Models\User::class, 10)->create();
    }
}
