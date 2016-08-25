<?php namespace App\Repositories;

use App\Models\Permission;
use App\Models\Role;
use App\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository
{
	/**
	* Create a new ContactRepository instance.
	*
	* @param  App\Models\Contact $permission
	* @return void
	*/
	public function __construct(Permission $permission)
	{
		$this->model = $permission;
	}


	public function indexPermissions()
	{
		return Permission::all();
	}

	/**
	* Store a permission.
	*
	* @param  array $inputs
	* @return void
	*/
	public function store($inputs)
	{
		$permission = new $this->model;
		$permission->name = $inputs['name'];
		$permission->display_name = $inputs['display_name'];
		$permission->description = $inputs['description'];
		$permission->save();
	}

	public function update($inputs, $id)
    {
        Permission::where('id', $id)->update($inputs);
    }

	public function destroy($id)
	{
		$role = Role::findOrFail($id);
		$role->delete();
	}


}
