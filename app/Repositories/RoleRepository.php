<?php

namespace App\Repositories;
use App\Models\Role;
use App\User;

class RoleRepository extends BaseRepository
{
  public function __construct(Role $role)
	{
		$this->model = $role;
	}

  public function indexRoles()
  {
    return Role::all();
  }

  public function indexUsers()
  {
    return User::all();
  }

  public function store($inputs)
	{
    $owner = new Role();
    $owner->name         = $inputs['name'];
    $owner->display_name = $inputs['display_name'];
    $owner->description  = $inputs['description'];
    $owner->save();
	}

  public function edit($inputs)
	{

	}

}
