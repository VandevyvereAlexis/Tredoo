<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->paginate(10);
        return response()->json($users, 200);
    }





    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        // Gestion de l'upload de l'image de profil
        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('profile_images', 'public');
        } else {
            $data['profile_image'] = 'profile_images/default.jpg';
        }

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return response()->json([
            'message' => 'Utilisateur créé avec succès.',
            'user' => $user
        ], 201);
    }





    public function show($id)
    {
        $user = User::with(['role', 'annonces'])->find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Utilisateur non trouvé.',
            ], 404);
        }

        return response()->json([
            'message' => 'Détails de l\'utilisateur récupérés avec succès.',
            'user' => $user
        ], 200);
    }





    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        // Gestion de l'upload de l'image de profil (si fourni)
        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('profile_images', 'public');
        }

        $user->update($data);

        return response()->json([
            'message' => 'Utilisateur mis à jour avec succès.',
            'user' => $user
        ], 200);
    }





    public function destroy(User $user)
    {
        //
    }
}
