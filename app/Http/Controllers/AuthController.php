<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\ChangeUserInfoFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $validation = (object) $request->validated();
        $credentials = $request->only('email', 'password');
        $remember = $request->remember;

        if (Auth::attempt($credentials, $remember)) {

            $user = User::where('email', $validation->email)->first();
            $token = $user->createToken('access-token')->plainTextToken;

            return $this->Success(message: 'successfuly loged-in', data: ['user' => $user, 'token' => $token]);
        } else {
            return response()->json(['message' => 'Invalid credentials', 'error' => 'Invalid credentials'], 401);
        }
    }

    public function update(ChangeUserInfoFormRequest $request)
    {
        $user = User::find(auth()->user()->id);

        return $this->UpdateAction($request, $user);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
