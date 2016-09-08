<?php

namespace App\Http\Controllers;

use App\Http\Services\Helper;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Mail;
use JWTAuth;

class UsersController extends Controller
{

    const ADMIN_NAME = 'role_admin';
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
     * @param Request $userRequest
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function createUser(Request $userRequest) {

        $newUser = $this->userRepository->createUser($userRequest->get('data'));
        $newUser->save();

        /* TODO TEST WITH THE MAIL SERVER CONFIGURED */
        // $url = route('userValidation', ['token' => $newUser->validation_token]);
        //$this->helper->sendMail($newUser, 'noreply@oda.com', trans('user.register.validation', [], 'user'), 'emails.validation', ['url' => $url]);

        return $this->helper->createResponse($newUser, 200, trans("user.response.success", [], 'user'));

    }


    /**
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */

    public function validateUserAccount($token){

        $user = User::where('validation_token', $token)->first();

        if($user){
            $user = $this->userRepository->validateUser($user);
            $user->save();

            return $this->helper->createResponse($user, 200, trans("user.response.success", [], 'user'));

        }

    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function isAdmin() {

        $user = JWTAuth::parseToken()->authenticate();
        $role = $this->userRepository->getUserRole($user->id);

        if($role->name == self::ADMIN_NAME) {
            return $this->helper->createResponse(['is_admin' => true], 200, trans('user.is_admin'));
        }
        return $this->helper->createResponse(['is_admin' => false], 200, trans('user.is_not_admin'));
    }


}
