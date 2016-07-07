<?php
namespace App\Repositories;

 use App\Models\User;
/**
 * Class UserRepository
 */
class UserRepository
{
    protected $user;
    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * @param $data
     * @return User
     */
    public function store($data) {

        $this->user->username = $data['username'];
        $this->user->email = $data['email'];
        $this->user->password = $data['password'];
        $this->user->firstname = $data['firstname'];
        $this->user->lastname = $data['lastname'];
        $this->user->address = $data['address'];
        $this->user->zipcode = $data['zipcode'];
        $this->user->city = $data['city'];
        $this->user->phone = $data['phone'];
        $this->user->ip = $data['ip'];
        $this->user->isProspect = $data['isProspect'];
        $this->user->createdAt = $data['createdAt'];

        $this->user->save();
        return $this->user;
    }
}