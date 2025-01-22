<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(10);
        return response()->json($roles, 200);
    }





    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $data = $request->validated();
        $role = Role::create($data);

        return response()->json([
            'message' => 'Rôle créé avec succès.',
            'role' => $role
        ], 201);
    }





    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Récupération du rôle avec ses utilisateurs associés
        $role = Role::with('users')->find($id);

        // Vérification si le rôle existe
        if (!$role) {
            return response()->json([
                'message' => 'Rôle non trouvé.',
            ], 404);
        }

        // Retour des détails du rôle
        return response()->json([
            'message' => 'Détails du rôle récupérés avec succès.',
            'role' => $role
        ], 200);
    }





    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
