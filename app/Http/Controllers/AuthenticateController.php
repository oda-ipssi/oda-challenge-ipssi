<?php

namespace App\Http\Controllers;

use App\Http\Services\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class AuthenticateController extends Controller
{

    /**
     * @var Helper $helper
     */
    private $helper;

    /**
     * AuthenticateController constructor.
     * @param Helper $helper
     */
    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request) {

        $credentials = $request->get('data');

        if(!$request->get('data')) {
            $credentials = [
                'email' => $request->get('email'),
                'password' => $request->get('password')
            ];
        }

        try {
        if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $user = Auth::user();
        $idSession = $request->getSession()->getId();

        return response()->json(compact('token', 'user', 'idSession'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function logOut(Request $request) {

        try {
            if(JWTAuth::invalidate(JWTAuth::getToken()) === true) {
                return $this->helper->createResponse([], 200, 'logout.ok');
            }

        } catch (TokenExpiredException $e) {
            $user = User::first();
            $token = JWTAuth::fromUser($user);
            if(JWTAuth::invalidate($token) === true) {
                return $this->helper->createResponse([], 200, 'logout.ok');
            }
        }

        return $this->helper->createResponse([], 422, 'logout.not.ok');

    }

}
