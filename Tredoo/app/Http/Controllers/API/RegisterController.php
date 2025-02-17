<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function register(RegisterUserRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('profile_images', 'public');
        } else {
            $data['profile_image'] = 'profile_images/default.jpg'; 
        }

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        Auth::login($user);

        return response()->json([
            'message' => 'Inscription réussie.',
            'user'    => $user
        ], 201);
    }
}
