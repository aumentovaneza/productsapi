<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $rules = array(
            'email'    => 'required|email',
            'password' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Incorrect Credentials']);
        }

        $userData = [
            'email'       => $request->email,
            'password'    => $request->password
        ];

        if(Auth::attempt($userData)) {
            //generate the token for the user
            $user_login_token = Auth::user()->createToken('LaravelProductTest')->accessToken;

            return response()->json(['data' => [
               'user' => Auth::user(),
               'accessToken' => $user_login_token
            ]], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Unable to login user. Please contact your administrator'], 404);
        }


    }
}
