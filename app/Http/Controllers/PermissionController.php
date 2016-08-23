<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\PermissionRequest;
use App\Repositories\PermissionRepository;
use App\Models\Permission;
use File;
use Session;
// use Illuminate\Routing\Route;

class PermissionController extends Controller
{

    protected $PermissionRepository;
    protected $permissions;

    public function __construct(PermissionRepository $PermissionRepository)
  	{
  		  $this->PermissionRepository = $PermissionRepository;
        $this->permissions = Permission::all();
  	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PermissionRepository $permissionManager)
    {
        return response()->json([
            'permissions' => $permissionManager->indexPermissions()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $this->PermissionRepository->store($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $this->PermissionRepository->update($request->all(), $id);
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
