<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request) {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $authUser = User::find(Auth::user()->id);
            $authUser->load('role');

            return response()->json([$authUser, 'Vous êtes connecter']);
        } else {
            return response()->json(['Echec de la connexion.', 'errors' => 'Email ou mot de passe incorrect']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
