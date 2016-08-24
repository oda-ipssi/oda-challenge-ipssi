<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PaymentsTableSeeder extends Seeder
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
        $users_id = DB::table('users')->select('id')->get();

        foreach($orders_id as $order){
            DB::table('payments')->insert([
                'order_id' => $order->id,
                'user_id' => $faker->randomElement($users_id)->id,
                'billingType' => 'Credit card',
                'amount' => $faker->randomFloat($nbMaxDecimals = 2, $min = 20, $max = 150),
                'cardNumber' => $faker->creditCardNumber(),
                'expirationDate' => $faker->creditCardExpirationDateString() ,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

    }
}