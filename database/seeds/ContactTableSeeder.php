<?php

use Illuminate\Database\Seeder;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact')->insert([
            'name' => 'Cartman',
            'email' => 'eric.cartman@gmail.com',
            'message' => "Dude I'll make you eat your parents"
        ]);

        DB::table('contact')->insert([
            'name' => 'White',
            'email' => 'walter.white@gmail.com',
            'message' => "I'am not in danger Sky, I am the danger"
        ]);

        DB::table('contact')->insert([
            'name' => 'Batman',
            'email' => 'the.bat@gmail.com',
            'message' => "This isn't a car"
        ]);


    }
}
