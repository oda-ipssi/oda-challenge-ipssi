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
    public function store($data, User $user) {

        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->address = $data['address'];
        $user->zipcode = $data['zipcode'];
        $user->city = $data['city'];
        $user->phone = $data['phone'];
        $user->ip = $_SERVER['REMOTE_ADDR'];

        if($data['password']){
            $bcrypHasher = new BcryptHasher();
            $user->password = $bcrypHasher->make($data['password']);
        }
        $user->is_prospect = isset($data['is_prospect']) ? $data['is_prospect'] : false;

        return $user;

    }
}