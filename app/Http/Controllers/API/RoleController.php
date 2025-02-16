<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    public function __construct()
    {
        // Toutes les actions nécessitent une authentification
        $this->middleware('auth:sanctum');
    }





    public function index()
    {
        $this->authorize('viewAny', Role::class);

        $roles = Role::paginate(10);
        return response()->json($roles, 200);
    }





    public function store(StoreRoleRequest $request)
    {
        $this->authorize('create', Role::class);

        $data = $request->validated();
        $role = Role::create($data);

        return response()->json([
            'message' => 'Rôle créé avec succès.',
            'role' => $role
        ], 201);
    }





    public function show($id)
    {
        $role = Role::with('users')->find($id);

        if (!$role) {
            return response()->json([
                'message' => 'Rôle non trouvé.',
            ], 404);
        }

        $this->authorize('view', $role);

        return response()->json([
            'message' => 'Détails du rôle récupérés avec succès.',
            'role' => $role
        ], 200);
    }





    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->authorize('update', $role);

        $data = $request->validated();
        $role->update($data);

        return response()->json([
            'message' => 'Rôle mis à jour avec succès.',
            'role' => $role
        ], 200);
    }





    public function destroy($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json([
                'message' => 'Rôle non trouvé.',
            ], 404);
        }

        $this->authorize('delete', $role);

        $role->delete();

        return response()->json([
            'message' => 'Rôle supprimé avec succès.',
        ], 200);
    }
}
