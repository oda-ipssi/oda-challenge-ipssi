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
            'description' => '
<li><strong>30 jours</strong> d\'essais</li>
<li><strong>Pas</strong> de support</li>
<li><strong>Pas</strong> de mise à jour</li>
<li><strong>1 utilisateur</strong> </li>
<li><strong>32 MB</strong> bandwidth</li>
<li><strong>Pas</strong> de securité</li>
',
            'database_limit' => 1,
            'price' => 0
        ]);

        DB::table('offers')->insert([
            'title' => 'medium',
            'has_support' => false,
            'user_limit' => 10,
            'has_update' => false,
            'description' => '
<li>Usage <strong>illimité</strong></li>
<li>Support <strong>gratuit</strong></li>
<li>Mises à jours<strong>gratuites</strong></li>
<li>jusqu\'à<strong>10 utilisateurs</strong></li>
<li><strong>1 GB</strong> bandwidth</li>
<li>Package <strong>sécurité</strong></li>
						',
            'database_limit' => 3,
            'price' => 14.99
        ]);

        DB::table('offers')->insert([
            'title' => 'premium',
            'has_support' => true,
            'user_limit' => 50,
            'has_update' => true,
            'description' => '
<li>Usage <strong>illimité</strong></li>
<li>Support <strong>gratuit</strong></li>
<li>Mises à jours<strong>gratuites</strong></li>
<li>jusqu\'à<strong>100 utilisateurs</strong></li>
<li><strong>10 GB</strong> bandwidth</li>
<li>Package <strong>sécurité</strong></li>
						',
            'database_limit' => -1,
            'price' => 27.99
        ]);
    }
}
