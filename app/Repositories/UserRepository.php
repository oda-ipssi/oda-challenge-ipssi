<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Hashing\BcryptHasher;

/**
 * Class UserRepository
 */
class UserRepository
{
    /**
     * @param $data
     * @param User $user
     * @return User
     * @throws \Exception
     */
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
     * @param $data
     * @return User
     */
    public function createUser($data){
        $user = new User();

        $user = $this->editUserInformation($data,$user);
        $user = $this->editUserPassword($data['password'],$user);

        $user->is_active = isset($data['is_active']) ? $data['is_active'] : 0;
        $now = new \DateTime();
        $user->validation_token = md5($now->format('YmdHis'));
        $user->is_prospect = true;

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
}