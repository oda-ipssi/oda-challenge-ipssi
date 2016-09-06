<?php

use Illuminate\Database\Seeder;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('offers')->insert([
            'title' => 'minimal',
            'has_support' => true,
            'user_limit' => 5,
            'has_update' => false,
            'description' => 'Hodor! Hodor hodor, HODOR hodor, hodor hodor?! Hodor, hodor. Hodor. Hodor, hodor HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor hodor - hodor; hodor HODOR hodor, hodor hodor hodor! Hodor hodor - hodor hodor hodor. Hodor! Hodor hodor, hodor hodor hodor hodor HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor! Hodor hodor, HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor. Hodor hodor, hodor. Hodor hodor hodor hodor hodor hodor. Hodor hodor HODOR! Hodor hodor; hodor hodor hodor.',
            'database_limit' => 1,
            'price' => 9.99
        ]);

        DB::table('offers')->insert([
            'title' => 'medium',
            'has_support' => false,
            'user_limit' => 10,
            'has_update' => false,
            'description' => 'Hodor! Hodor hodor, HODOR hodor, hodor hodor?! Hodor, hodor. Hodor. Hodor, hodor HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor hodor - hodor; hodor HODOR hodor, hodor hodor hodor! Hodor hodor - hodor hodor hodor. Hodor! Hodor hodor, hodor hodor hodor hodor HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor! Hodor hodor, HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor. Hodor hodor, hodor. Hodor hodor hodor hodor hodor hodor. Hodor hodor HODOR! Hodor hodor; hodor hodor hodor.',
            'database_limit' => 3,
            'price' => 14.99
        ]);

        DB::table('offers')->insert([
            'title' => 'premium',
            'has_support' => true,
            'user_limit' => 50,
            'has_update' => true,
            'description' => 'Hodor! Hodor hodor, HODOR hodor, hodor hodor?! Hodor, hodor. Hodor. Hodor, hodor HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor hodor - hodor; hodor HODOR hodor, hodor hodor hodor! Hodor hodor - hodor hodor hodor. Hodor! Hodor hodor, hodor hodor hodor hodor HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor! Hodor hodor, HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor. Hodor hodor, hodor. Hodor hodor hodor hodor hodor hodor. Hodor hodor HODOR! Hodor hodor; hodor hodor hodor.',
            'database_limit' => -1,
            'price' => 27.99
        ]);
    }
}
