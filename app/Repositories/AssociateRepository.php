<?php

namespace App\Repositories;
use App\Models\Associate;
use App\Models\User;
use Auth;
use Mail;
use Illuminate\Hashing\BcryptHasher;

class AssociateRepository extends BaseRepository
{

    public function __construct(Associate $role)
    {
        $this->model = $role;
    }

    public function indexRegistered()
    {
        // List of all users with role registered -> For search a new user
        $registered = Associate::join('role_user', 'roles.id', '=', 'role_user.role_id')
            ->join('users', 'role_user.user_id', '=', 'users.id')
            ->where('roles.name', 'role_registered')
            ->get();
        return $registered;
    }

    public function indexCustomer()
    {
        // $idUser = Auth::user()->id;
        $idUser = 2;
        if(!empty($idUser)){
            // Select all users with role undercustomer and with parent current id_customer
            $undercustomer = Associate::join('role_user', 'roles.id', '=', 'role_user.role_id')
                ->join('users', 'role_user.user_id', '=', 'users.id')
                ->where('roles.name', 'role_undercustomer')
                ->where('users.id_customer', $idUser)
                ->get();
            return $undercustomer;
        }
    }


    public function editUserInformation($data, User $user){

        $user->username = isset($data['username']) ? $data['username'] : $user->username;
        $user->email = isset($data['email']) ? $data['email'] : $user->email;
        $user->firstname = isset($data['firstname']) ? $data['firstname'] : $user->firstname;
        $user->lastname = isset($data['lastname']) ? $data['lastname'] : $user->lastname;
        $user->address = isset($data['address']) ? $data['address'] : $user->address;
        $user->zipcode = isset($data['zipcode']) ? $data['zipcode'] : $user->zipcode;
        $user->city = isset($data['city']) ? $data['city'] : $user->city;
        $user->phone = isset($data['phone']) ? $data['phone'] : $user->phone;
        $user->ip = $_SERVER['REMOTE_ADDR'];

        return $user;

    }
    /**
     * @param $password
     * @param User $user
     * @return User
     */
    public function editUserPassword($password, User $user){

        $bcrypHasher = new BcryptHasher();
        $user->password = $bcrypHasher->make($password);

        return $user;
    }

    /**
     * @param $user
     *
     */
    public function validateUser($user){
        $user->is_active = 1;
        return $user;
    }


    public function store($data, $idUser)
    {
      $user = new User();

      $user = $this->editUserInformation($data,$user);
      $user = $this->editUserPassword($data['password'],$user);
      $user->id_customer = $idUser;



      $user->is_active = isset($data['is_active']) ? $data['is_active'] : 0;
      $now = new \DateTime();
      $user->validation_token = md5($now->format('YmdHis'));
      $user->is_prospect = true;

      return $user;
		}


    public function update($inputs, $id)
    {
        Associate::where('id', $id)->update($inputs);
    }

    public function destroy($id)
	{
        $role = Associate::findOrFail($id);
        $role->delete();
	}

}
