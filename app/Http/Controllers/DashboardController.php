<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Contact;
use App\Models\Offer;
use App\Repositories\DockerDatabaseInstanceRepository;
use App\Repositories\OfferRepository;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
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

    /** @var  DockerDatabaseInstanceRepository $ddInstanceRepository */
    private $ddInstanceRepository;

    /** @var  Helper $helper */
    private $helper;

    /**
     * DashboardController constructor.
     * @param OfferRepository $offerRepository
     * @param UserRepository $userRepository
     * @param OrderRepository $orderRepository
     * @param Helper $helper
     */
    public function __construct(OfferRepository $offerRepository, UserRepository $userRepository, OrderRepository $orderRepository, DockerDatabaseInstanceRepository $ddInstanceRepository, Helper $helper)
    {
        $this->offerRepository = $offerRepository;
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
        $this->orderRepository = $orderRepository;
        $this->ddInstanceRepository = $ddInstanceRepository;
        $this->helper = $helper;
    }



    public function getActiveUsersNumber() {

        $activeUsersNumber = $this->userRepository->getActiveUsersNumber();
        $activeAdminNumber = $this->userRepository->getAdminUsersNumber();
        $activeCustomerNumber = $this->userRepository->getCustomerUsersNumber();
        $activeRegisteredNumber = $this->userRepository->getRegisteredUsersNumber();


        return $this->helper->createResponse(['number' => $activeUsersNumber, 'total_admin' => $activeAdminNumber, 'total_customer' => $activeCustomerNumber, 'total_registered' => $activeRegisteredNumber],200,'Success');
    }

    public function getValidOrdersNumber() {

        $validOrdersNumber = $this->orderRepository->getValidOrdersNumber();
        $validOrdersSum = $this->orderRepository->getValidOrdersSum();
        $validOrdersNumberSub1 = $this->orderRepository->getValidOrdersNumberSub1();
        $validOrdersNumberSub2 = $this->orderRepository->getValidOrdersNumberSub2();
        $validOrdersNumberSub3 = $this->orderRepository->getValidOrdersNumberSub3();

        $validOrdersSumSub1 = $this->orderRepository->getValidOrdersSumSub1();
        $validOrdersSumSub2 = $this->orderRepository->getValidOrdersSumSub2();
        $validOrdersSumSub3 = $this->orderRepository->getValidOrdersSumSub3();

        return $this->helper->createResponse(
            [   'number' => $validOrdersNumber,
                'sum' => $validOrdersSum,
                'total_sub1' => $validOrdersNumberSub1,
                'total_sub2' => $validOrdersNumberSub2,
                'total_sub3' => $validOrdersNumberSub3,
                'sum_sub1' => $validOrdersSumSub1,
                'sum_sub2' => $validOrdersSumSub2,
                'sum_sub3' => $validOrdersSumSub3
            ],200,'Success');
    }


    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getDatabasesNumber() {

        return $this->helper->createResponse($this->ddInstanceRepository->getDatabasesNumber(), 200, trans('dashboard.response.ok', [], 'dashboard'));

    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getEmailFromActiveUsers() {

        $activeUsersEmail = $this->userRepository->getEmailFromActiveUsers();

        if($activeUsersEmail) {

            return $this->helper->createResponse($activeUsersEmail, 200, trans('dashboard.response.ok', [], 'dashboard'));
        } else {

            return $this->helper->createResponse([], 404, trans('dashboard.emails_active_user.empty', [], 'dashboard'));
        }

    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getContactMessages() {

        $contactMessages = Contact::all();

        if($contactMessages) {

            return $this->helper->createResponse($contactMessages, 200, trans('dashboard.response.ok', [], 'dashboard'));
        } else {

            return $this->helper->createResponse([], 404, trans('dashboard.contact_message.empty', [], 'dashboard'));
        }

    }


}
