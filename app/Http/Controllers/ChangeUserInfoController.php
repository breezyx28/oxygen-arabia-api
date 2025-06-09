<?php

namespace App\Http\Controllers;

use App\Http\Requests\Update\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangeUserInfoController extends Controller
{
    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $userModel = User::find($user->id);

        $validate =  $request->validated();

        $filter = (object) array_filter($validate, function ($item) {
            return $item != null || $item != '';
        });

        foreach ($filter as $key => $value) {
            $userModel->$key = $value;

            if ($key == "password") {
                $userModel->$key = Hash::make($value);
            }
        }

        try {
            $userModel->save();

            $token = $userModel->createToken('access-token')->plainTextToken;
            return $this->Success(message: 'successfuly updated', data: ['user' => $userModel, 'token' => $token]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Invalid credentials', 'error' => 'Invalid credentials'], 401);
        }
    }
}
