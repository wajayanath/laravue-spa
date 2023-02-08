<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        if(Auth::attempt($request->only('email','password'))) {
            $user = Auth::user();

            $token = $user->createToken('admin')->accessToken;

            // $cookie = \cookie('jwt', $token, 3600);

            return \response([
                'token' => $token,
            ]);
            // ->withCookie($cookie);
        }
        return response([
            'error' => 'Invalid Credentials'
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::where('email', '=', $request->input('email'))->first();
        if ($user === null) {
            $user = User::create($request->only('first_name', 'email', 'role_id') + [
                'password' => Hash::make($request->input('password'))
            ]);
            return response($user, Response::HTTP_CREATED);
        } else {
            return response(['msg'=>'The user email has already exists'], Response::HTTP_OK);
        }
    }
}
