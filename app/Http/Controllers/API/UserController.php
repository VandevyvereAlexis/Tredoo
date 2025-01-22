<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->paginate(10);
        return response()->json($users, 200);
    }





    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        // Gestion de l'upload de l'image de profil
        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('profile_images', 'public');
        } else {
            $data['profile_image'] = 'profile_images/default.jpg'; // Chemin par défaut
        }

        // Hachage du mot de passe
        $data['password'] = bcrypt($data['password']);

        // Création de l'utilisateur
        $user = User::create($data);

        return response()->json([
            'message' => 'Utilisateur créé avec succès.',
            'user' => $user
        ], 201);
    }





    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Récupération de l'utilisateur avec son rôle et ses annonces
        $user = User::with(['role', 'annonces'])->find($id);

        // Vérification si l'utilisateur existe
        if (!$user) {
            return response()->json([
                'message' => 'Utilisateur non trouvé.',
            ], 404);
        }

        // Retour des détails de l'utilisateur
        return response()->json([
            'message' => 'Détails de l\'utilisateur récupérés avec succès.',
            'user' => $user
        ], 200);
    }





    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
