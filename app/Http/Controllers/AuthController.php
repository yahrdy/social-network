<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): UserResource
    {
        $data = $request->validated();
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        return new UserResource($user);
    }

    public function login(LoginRequest $request){
        $user = User::whereEmail($request->email)->first();
        if ($user and Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $token = $user->createToken('web token')->plainTextToken;
        }
        return response(['token' => $token, 'user' => new UserResource($user)]);
    }
}
