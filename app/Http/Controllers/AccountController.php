<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Psy\Util\Json;
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

}
