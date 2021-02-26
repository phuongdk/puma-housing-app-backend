<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseAPIController
{
    public function login(Request $request)
    {
        $login = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        if (!Auth::attempt($login)) {
            return response(['error' => ['message' => 'Invalid login credentials.']]);
            return $this->responseJSON(['error' => ['message' => 'Invalid login credentials!']], 400);
        }

        $accessToken = Auth::user()->createToken('PumaHousing')->accessToken;

        return $this->responseJSON(['user' => Auth::user(), 'token' => $accessToken]);
    }

    public function register(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->responseJSON(['error' => ['message' => 'Validation error, please check fields!']], 400);
        }
        if (User::where('username', $request->username)->exists()) {
            return $this->responseJSON(['error' => ['message' => 'This username is already taken!']], 400);
        }
        if (User::where('email', $request->email)->exists()) {
            return $this->responseJSON(['error' => ['message' => 'This email is already taken!']], 400);
        }
        $user = User::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);
        $success['user'] = $user;
        $success['token'] = $user->createToken('PumaHousing')->accessToken;
        return $this->responseJSON(['success' => $success], 200);
    }
}
