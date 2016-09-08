<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AssociateRequest;
use App\Repositories\AssociateRepository;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UserRequest;
use App\Http\Services\Helper;
use JWTAuth;

class AssociateController extends Controller
{
    /**
     * @var Helper
     */
    private $helper;

    public function __construct(AssociateRepository $role_gestion, Helper $helper)
    {
      $this->AssociateRepository = $role_gestion;
      $this->helper = $helper;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AssociateRepository $roleManager)
    {
        return response()->json([
            'undercustomer' => $roleManager->indexCustomer()
        ]);
    }


    /**
     * @param UserRequest $userRequest
     * @param AssociateRepository $associate_gestion
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(UserRequest $userRequest, AssociateRepository $associate_gestion)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $newUser = $associate_gestion->store($userRequest->get('data'), $user->id);
        $newUser->save();

        $roleUndercustomer = Role::where('name', 'role_undercustomer')->first();

        $newUser->attachRole($roleUndercustomer);

        return $this->helper->createResponse($newUser, 200, trans("user.response.success", [], 'user'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->AssociateRepository->destroy($id);
    }
}
