<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $request)
    {
        $validator = $request->validated();
        User::query()->create($validator);
        return success();
    }

    public function login(AuthLoginRequest $request)
    {
        $validator = $request->validated();

        $email = $validator['email'];
        $password = $validator['password'];
        $user = User::query()->where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return response(['message' => 'Invalid Credentials'], 401);
        }
        $token = $user->createToken('token')->plainTextToken;
        return success($token);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return success();
    }
}
