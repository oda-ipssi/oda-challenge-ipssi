<?php

namespace App\Http\Controllers;

use App\Http\Services\Helper;
use Illuminate\Http\Request;
use Illuminate\Auth;
use Illuminate\Hashing\BcryptHasher;
use App\Http\Requests;
use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class AccountController extends Controller
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
     * AccountController constructor.
     * @param UserRepository $userRepository
     * @param Helper $helper
     */
    public function __construct(UserRepository $userRepository, Helper $helper) {
        $this->userRepository = $userRepository;
        $this->helper = $helper;

    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{

            $user = User::findOrFail($id);
            return $this->helper->createResponse($user, 200, trans("user.response.ok", [], 'user'));

        } catch (ModelNotFoundException $e) {

            return $this->helper->createResponse("", 404, trans("user.response.notfound", [], 'user'));

        }

    }

    /**
     * @param $id
     * @param UserRequest $userRequest
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update($id, UserRequest $userRequest)
    {

        try{

            $accountUser = $this->userRepository->editUserInformation($userRequest->get('data'), User::findOrFail($id));

            return $this->helper->createResponse($accountUser, 200, trans('user.edit.success'));

        } catch (ModelNotFoundException $e) {

            return $this->helper->createResponse("", 404, trans('user.response.notfound'));

        }

    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function editPassword($id, Request $request) {

        if($request->ajax()) {

            $password = $request->get('data')['password'];
            $newPassword = $request->get('data')['new_password'];

            $user = User::findOrFail($id);
            $bcrypHasher = new BcryptHasher();

            $passwordValidated = Validator::make($request->all(), [
                'password' => 'required'
            ]);

            /** @var \Illuminate\Validation\Validator $passwordValidated */
            if($passwordValidated->passes()) {

                if ($bcrypHasher->check($password, $user->password)) {

                    $newPasswordValidated = Validator::make($request->all(), [
                        'new_password' => 'required|different:password'
                    ]);

                    /** @var \Illuminate\Validation\Validator $newPasswordValidated */
                    if ($newPasswordValidated->passes()) {
                        return $this->helper->createResponse($this->userRepository->editUserPassword($newPassword,$user), 200, trans('user.edit.success', [], 'user'));
                    }

                } else {
                    return $this->helper->createResponse("", 422, trans('user.response.error', [], 'user'));
                }

            }
        }

    }

}
