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
    $listRole = $this->role;
    dd($listRole);
  }

  public function store($inputs)
	{
    $owner = new Role();
    $owner->name         = $inputs['name'];
    $owner->display_name = $inputs['display_name'];
    $owner->description  = $inputs['description'];
    $owner->save();

	}

}
