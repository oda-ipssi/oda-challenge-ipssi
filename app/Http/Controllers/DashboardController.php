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
        return $this->helper->createResponse($this->userRepository->getAllUsersNumber(),200,'Success');
    }

    public function getActiveUsersNumber() {
        return $this->helper->createResponse($this->userRepository->getActiveUsersNumber(),200,'Success');
    }

    public function getValidOrdersNumber() {
        return $this->helper->createResponse($this->orderRepository->getValidOrdersNumber(),200,'Success');
    }

    public function getValidOrdersSum() {
        return $this->helper->createResponse($this->orderRepository->getValidOrdersSum(),200,'Success');
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
