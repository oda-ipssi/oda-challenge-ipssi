<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Repositories\OfferRepository;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Services\Helper;

class DashboardController extends Controller
{

    /**
     * @var OfferRepository $offerRepository
     */
    private $offerRepository;

    /** @var  UserRepository $userRepository */
    private $userRepository;

    /** @var  OrderRepository $orderRepository */
    private $orderRepository;

    /** @var  Helper $helper */
    private $helper;

    /**
     * DashboardController constructor.
     * @param OfferRepository $offerRepository
     * @param UserRepository $userRepository
     * @param OrderRepository $orderRepository
     * @param Helper $helper
     */
    public function __construct(OfferRepository $offerRepository, UserRepository $userRepository, OrderRepository $orderRepository, Helper $helper)
    {
        $this->offerRepository = $offerRepository;
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
        $this->helper = $helper;
    }


    public function getAllUsersNumber() {

        // todo implement

    }

    public function getActiveUsersNumber() {

        // todo implement
    }

    public function getValidOrdersNumber() {

        // todo implement
    }

    public function getValidOrdersSum() {

        // todo implement

    }

    public function getDatabasesNumber() {

        // todo implement

    }

    public function getEmailFromActiveUsers() {

        // todo implement
    }

    public function getContactMessages() {

        // todo implement

    }


}
