<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
class AuthenticateController extends Controller
{

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

    public function logOut(Request $request) {

        JWTAuth::invalidate(JWTAuth::getToken());

    }

}
