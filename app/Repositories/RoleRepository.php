<?php

namespace App\Repositories;
use App\Models\Role;
use App\Models\User;
use Auth;
use Mail;

class RoleRepository extends BaseRepository
{

    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function indexRegistered()
    {
        // List of all users with role registered -> For search a new user
        $registered = Role::join('role_user', 'roles.id', '=', 'role_user.role_id')
            ->join('users', 'role_user.user_id', '=', 'users.id')
            ->where('roles.name', 'role_registered')
            ->get();
        return $registered;
    }

    public function indexCustomer()
    {
        $idUser = Auth::user()->id;
        // $idUser = 2;
        if(!empty($idUser)){
            // Select all users with role undercustomer and with parent current id_customer
            $undercustomer = Role::join('role_user', 'roles.id', '=', 'role_user.role_id')
                ->join('users', 'role_user.user_id', '=', 'users.id')
                ->where('roles.name', 'role_undercustomer')
                ->where('users.id_customer', $idUser)
                ->get();
            return $undercustomer;
        }
    }

    public function store($inputs)
    {
        Mail::send('emails.invitation', $data = array(
			'email' => 'winceweb@gmail.com',
            'customerName' => 'testNom',
            'lien' => '/test'
		),
		function($message) use ($data){

			if(count(Mail::failures()) > 0){
				echo "Erreurs : <br />";

				foreach(Mail::failures as $email_address) {
					echo " - $email_address <br />";
				}
			}else{
				$message->subject('Invitation administration du site')
				->to('admin@example.net')
				->replyTo($data['email']);
			}

		});

        // $owner = new Role();
        // $owner->name         = $inputs['name'];
        // $owner->display_name = $inputs['display_name'];
        // $owner->description  = $inputs['description'];
        // $owner->save();
    }

    public function update($inputs, $id)
    {
        Role::where('id', $id)->update($inputs);
    }

    public function destroy($id)
	{
        $role = Role::findOrFail($id);
        $role->delete();
	}

}
