<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-8-13
 * Time: 下午12:39
 */

namespace App\Api\Controllers;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthController extends  BaseController
{
    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');
//        $credentials = [
//            'user_email' => $request->get('user_email'),
//            'passowrd' => $request->get('user_passowrd')
//        ];
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    //注册
    public function register(Request $request)
    {
        $newUser = [
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'password' => bcrypt($request->get('password')),
        ];

        $user = User::create($newUser);
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('token'));
    }

    public static function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'token_expired'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'token_invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['error' => 'token_absent'], $e->getStatusCode());
        }

        // the token is valid and we have found the user via the sub claim
        return $user;
    }
}