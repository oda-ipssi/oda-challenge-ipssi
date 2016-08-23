<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Auth;
use Illuminate\Hashing\BcryptHasher;
use App\Http\Requests;
use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRequest;
use Mockery\CountValidator\Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;



class AccountController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;



    /**
     * AccountController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;

    }



    /**
     * @param null $data
     * @param $status
     * @param $message
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    private function createResponse($data = null, $status, $message) {
        return response([
            'status' => $status,
            'data' => $data,
            'message' => $message
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{

            $user = User::findOrFail($id);
            return $this->createResponse($user, 200, "Ok");

        } catch (ModelNotFoundException $e) {

            return $this->createResponse("", 404, trans("user.response.notfound"));

        }


    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update($id, UserRequest $userRequest)
    {

        try{

            $accountUser = $this->userRepository->store($userRequest->get('data'), User::findOrFail($id));

            return $this->createResponse($accountUser, 200, trans('user.edit.success'));

        } catch (ModelNotFoundException $e) {

            return $this->createResponse("", 404, trans('user.response.notfound'));

        }


    }

    /**
     * @param $id
     * @param Request $request
     */
    public function editPassword($id, Request $request) {

        $password = $request->get('password');
        $newPassword = $request->get('new_password');

        $user = User::findOrFail($id);
        $bcrypHasher = new BcryptHasher();

        $passwordValidated = Validator::make($request->all(), [
            'password' => 'required'
        ]);

        /** @var \Illuminate\Validation\Validator $passwordValidated */
        if(!$passwordValidated->fails()) {

            $validation = $bcrypHasher->check($password, $user->password);
            if ($validation) {

                $newPasswordValidated = Validator::make($request->all(), [
                    'new_password' => 'required|different:password|confirmed',
                    'new_password_confirmation' => 'required'
                ]);

                /** @var \Illuminate\Validation\Validator $newPasswordValidated */
                if ($newPasswordValidated->fails()) {
                    return $this->createResponse("", 422, "fail");
                } else {
                    $user->password = $bcrypHasher->make($newPassword);
                    $user->save();

                    return $this->createResponse($user, 200, trans('user.edit.success'));
                }
            } else {
                return $this->createResponse("", 422, trans('user.response.error'));

            }
        }else {
            return $this->createResponse("", 422, trans('user.response.error'));
        }

    }

}
