<?php

use Illuminate\Database\Seeder;

class DatasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Data::class, 5)->create();
    }
}
