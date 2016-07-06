<?php

namespace App\Repositories;
use App\Models\Role;

class RoleRepository extends BaseRepository
{
  public function __construct(Role $role)
	{
		$this->model = $role;
	}

  public function index()
  {

  }

  public function store($inputs)
	{
		$role = new $this->model;

		$role->name = $inputs['name'];
		$role->display_name = $inputs['display_name'];
		$role->description = $inputs['description'];

		$role->save();
	}

}
