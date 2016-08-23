<?php

use Illuminate\Database\Seeder;

class OrdersOffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $orders_id = DB::table('orders')->select('id')->get();
        $offers_id = DB::table('offers')->select('id')->get();

        foreach($orders_id as $order){
            DB::table('orders_offers')->insert([
                'order_id' => $order->id,
                'offer_id' => $faker->randomElement($offers_id)->id
            ]);
        }
    }
}
