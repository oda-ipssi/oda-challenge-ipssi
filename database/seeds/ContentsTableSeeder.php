<?php

use Illuminate\Database\Seeder;

class ContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contents')->insert([
            'title' => 'Mentions légales',
            'content' => 'Hodor! Hodor hodor, HODOR hodor, hodor hodor?! Hodor, hodor. Hodor. Hodor, hodor HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor hodor - hodor; hodor HODOR hodor, hodor hodor hodor! Hodor hodor - hodor hodor hodor. Hodor! Hodor hodor, hodor hodor hodor hodor HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor! Hodor hodor, HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor. Hodor hodor, hodor. Hodor hodor hodor hodor hodor hodor. Hodor hodor HODOR! Hodor hodor; hodor hodor hodor.',
            'url' => '/mentions-legales'
        ]);

        DB::table('contents')->insert([
            'title' => 'FAQ',
            'content' => 'Hodor! Hodor hodor, HODOR hodor, hodor hodor?! Hodor, hodor. Hodor. Hodor, hodor HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor hodor - hodor; hodor HODOR hodor, hodor hodor hodor! Hodor hodor - hodor hodor hodor. Hodor! Hodor hodor, hodor hodor hodor hodor HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor! Hodor hodor, HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor. Hodor hodor, hodor. Hodor hodor hodor hodor hodor hodor. Hodor hodor HODOR! Hodor hodor; hodor hodor hodor.',
            'url' => '/faq'
        ]);

        DB::table('contents')->insert([
            'title' => 'CGU',
            'content' => 'Hodor! Hodor hodor, HODOR hodor, hodor hodor?! Hodor, hodor. Hodor. Hodor, hodor HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor hodor - hodor; hodor HODOR hodor, hodor hodor hodor! Hodor hodor - hodor hodor hodor. Hodor! Hodor hodor, hodor hodor hodor hodor HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor! Hodor hodor, HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor. Hodor hodor, hodor. Hodor hodor hodor hodor hodor hodor. Hodor hodor HODOR! Hodor hodor; hodor hodor hodor.',
            'url' => '/cgu'
        ]);

        DB::table('contents')->insert([
            'title' => 'CGV',
            'content' => 'Hodor! Hodor hodor, HODOR hodor, hodor hodor?! Hodor, hodor. Hodor. Hodor, hodor HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor hodor - hodor; hodor HODOR hodor, hodor hodor hodor! Hodor hodor - hodor hodor hodor. Hodor! Hodor hodor, hodor hodor hodor hodor HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor! Hodor hodor, HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor. Hodor hodor, hodor. Hodor hodor hodor hodor hodor hodor. Hodor hodor HODOR! Hodor hodor; hodor hodor hodor.',
            'url' => '/cgv'
        ]);

        DB::table('contents')->insert([
            'title' => 'Présentation de l\'entreprise',
            'content' => 'Hodor! Hodor hodor, HODOR hodor, hodor hodor?! Hodor, hodor. Hodor. Hodor, hodor HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor hodor - hodor; hodor HODOR hodor, hodor hodor hodor! Hodor hodor - hodor hodor hodor. Hodor! Hodor hodor, hodor hodor hodor hodor HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor! Hodor hodor, HODOR hodor, hodor hodor, hodor, hodor hodor. Hodor. Hodor hodor, hodor. Hodor hodor hodor hodor hodor hodor. Hodor hodor HODOR! Hodor hodor; hodor hodor hodor.',
            'url' => '/presentation'
        ]);
    }
}