<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\RoleRequest;
use App\Repositories\RoleRepository;

class RoleController extends Controller
{


    public function __construct(RoleRepository $role_gestion)
    {
      $this->role_gestion = $role_gestion;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoleRepository $roleManager)
    {
        return response()->json([
            'roles' => $roleManager->indexRoles(),
            'users' => $roleManager->indexUsers(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('role.addRole');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request, RoleRepository $roleManager)
    {
        $roleManager->store($request->all());

        return redirect('/role')->with('message', 'Rôle ajouté !');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(RoleRequest $request, RoleRepository $roleManager, $id)
    {
        $roleManager->edit($request->all());

        return redirect('/role')->with('message', 'Rôle modifié !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
