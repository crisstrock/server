<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\PayloadFactory;
use Tymon\JWTAuth\JWTManager as JWT;

class UserController extends Controller
{
    //Function to user register
    public function register(Request $request){
    	$validator = Validator::make($request->json()->all(), [
    		'name' => 'required|string|max:255',
    		'email' => 'required|email|max:255|unique:users',
    		'password' => 'required|string|min:6',
    	]);

    	if ($validator->fails()) {
    		return response()->json($validator->errors()->toJson(),400);
    	}

    	$user = User::create([
    		'name' => $request->json()->get('name'),
    		'email' => $request->json()->get('email'),
    		'password' => Hash::make($request->json()->get('password')),
    	]);

    	$token = JWTAuth::fromUser($user);

    	return response()->json(compact('user', 'token'), 201);
    }

//Function to user login
    public function login(Request $request){
    	//$credentials = $request->json()->all();
        $credentials = $request->only(['email', 'password']);
		
		try {
			if (!$token = JWTAuth::attempt($credentials)) {
				return response()->json(['error' => 'invalid_credentials'], 400);
			}
		} catch (JWTException $e) {
			return response()->json(['error' => 'could_not_create_token'], 500);
		}
		return response()->json(compact('token'));
    }

    public function getAuthenticatedUser(){//Request $request){
    	try {
            //$headers = apache_request_headers(); //get header
            //$request->headers->set('Authorization', $headers['authorization']);// set header in request

    		if (!$user = JWTAuth::parseToken()->authenticate()) {
    			return response()->json(['user_not_foud'], 404);
    		}
            //$token = str_replace("Bearer ", "", $request->header('Authorization'));
    	} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
    		return response()->json(['token_expired'], $e->getStatusCode());
    	} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
    		return response()->json(['token_invalid'], $e->getStatusCode());
    	} catch (Tymon\JWTAuth\Exceptions\JWTException $e){
    		return response()->json(['token_absent'], $e->getStatusCode());
    	}

    	return response()->json(compact('user'));
    }
}

