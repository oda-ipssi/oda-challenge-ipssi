<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Models\Role;

class AuthController extends Controller
{

    /**
     * @var Request $request
     */
    private $request;

    /**
     * AuthController constructor.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Login
     */
    public function login()
    {

        $login = $this->request->get('data')['login'];
        $password = $this->request->get('data')['password'];

        $users = User::all();
        $bcryptHasher = new BcryptHasher();

        foreach ($users as $user) {

            if ($login == $user->email && $bcryptHasher->check($password, $user->password) === true) {
                $this->request->session()->set('authenticated_user', $user->email);
                // todo retrieve id session
            }
        }
    }

    public function logout(Request $request) {

    }






}
