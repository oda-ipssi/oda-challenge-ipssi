<?php
namespace App\Repositories;

use App\Models\Offer;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

/**
 * Class OrderRepository
 */
class OrderRepository
{
    /**
     * @param Order $order
     * @param Offer $offer
     * @return Order
     */
    public function editOrder(Order $order, Offer $offer) {

        $order->offer_id = $offer->id;
        $order->updated_at = Carbon::now()->format('Y-m-d H:i:s');

        return $order;

    }

    /**
     * @param User $user
     * @param Offer $offer
     * @return Order
     */
    public function createOrder(User $user, Offer $offer){
        $order = new Order();

        $order->vat = 20;
        $order->status = Order::STATUS_OK;
        $order->user_id = $user->id;
        $order->offer_id = $offer->id;
        $order->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $order->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $order->price = $offer->price;

        return $order;

    }


    public function getValidOrdersNumber()
    {
        return Order::where('status',Order::STATUS_OK)->count();
    }

    public function getValidOrdersSum()
    {
        return Order::where('status',Order::STATUS_OK)->sum('price');
    }


}