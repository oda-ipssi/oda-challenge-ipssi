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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $userRequest, AssociateRepository $associate_gestion)
    {
          // $newUser = $this->userRepository->createUser($userRequest->get('data'));
          // $idUser = Auth::user()->id;
          $idUser = 2;
          $newUser = $associate_gestion->store($userRequest->all(), $idUser);
          $newUser->save();

          $roleUndercustomer = Role::where('name', 'role_undercustomer')->first();

          $newUser->attachRole($roleUndercustomer);

          /* TODO TEST WITH THE MAIL SERVER CONFIGURED */
          // $url = route('userValidation', ['token' => $newUser->validation_token]);
          //$this->helper->sendMail($newUser, 'noreply@oda.com', trans('user.register.validation', [], 'user'), 'emails.validation', ['url' => $url]);

          return $this->helper->createResponse($newUser, 200, trans("user.response.success", [], 'user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssociateRequest $request, $id)
    {
        $this->AssociateRepository->update($request->all(), $id);

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
