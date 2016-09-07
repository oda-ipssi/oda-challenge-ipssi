<?php
/**
 * Created by PhpStorm.
 * User: administrateur
 * Date: 07/09/16
 * Time: 11:03
 */

namespace App\Observers;
use App\Http\Requests\Request;
use App\Models\Offer;
use App\Models\Order;
use App\Models\User;
use App\Repositories\OrderRepository;


class UserObserver
{


    /** @var  OrderRepository $orderRepository */
    private $orderRepository;

    /**
     * UserObserver constructor.
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {

        $this->orderRepository = $orderRepository;
    }

    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(User $user)
    {
        $offerId = session('user-registration-offer');

        if($offerId) {
            $offer = Offer::findOrFail($offerId);
            $order = $this->orderRepository->createOrder($user, $offer);
            $order->save();

        }

    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        //
    }
}