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

        //dd($userRequest->get('data'));

        $newUser = $this->userRepository->createUser($userRequest->get('data'));
        $newUser->save();

        $url = route('userValidation', ['token' => $newUser->validation_token]);

        $this->helper->sendMail($newUser, 'noreply@oda.com', trans('user.register.validation', [], 'user'), 'emails.validation', ['url' => $url]);

        return $this->helper->createResponse($newUser, 200, trans("user.response.success", [], 'user'));



    }

    /**
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */

    public function validateUserAccount($token){

        $user = User::where('validation_token',$token)->first();

        if($user){
            $this->userRepository->validateUser($user);
            /* TODO redirect on the login page */
            return redirect()->route('home');
        }


    }

}
