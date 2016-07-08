<?php

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use App\User;
=======
use Carbon\Carbon;
>>>>>>> master

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD

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
=======
       factory(App\Models\User::class, 10)->create();
>>>>>>> master
    }
}
