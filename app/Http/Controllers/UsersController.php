<?php

namespace App\Http\Controllers;

use App\Http\Services\Helper;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var Helper
     */
    private $helper;

    /**
     * UsersController constructor.
     * @param UserRepository $userRepository
     * @param Helper $helper
     */
    public function __construct(UserRepository $userRepository, Helper $helper) {
        $this->userRepository = $userRepository;
        $this->helper = $helper;

    }


    /**
     * Display the specified resource.
     *
     * @param  UserRequest $userRequest
     * @return \Illuminate\Http\Response
     */
    public function createUser(UserRequest $userRequest) {

        if($userRequest->ajax()) {

            $newUser = $this->userRepository->store($userRequest->get('data'), new User());

            $this->helper->sendWelcomeMail($newUser, 'oda@gmail.com', trans('user.register.success', [], 'user'));

            return $this->helper->createResponse($newUser, 200, trans("user.response.success", [], 'user'));

        }

        return $this->helper->createResponse("", 422, trans("user.response.error"));

    }

}
