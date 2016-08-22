<?php
namespace App\Repositories;

 use App\Models\User;
/**
 * Class UserRepository
 */
class UserRepository
{

    /**
     * @param $data
     * @return User
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

        $user->save();

        return $user;
    }
}