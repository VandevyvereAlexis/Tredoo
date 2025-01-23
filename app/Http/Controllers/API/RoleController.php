<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);
        return response()->json($roles, 200);
    }





    public function store(StoreRoleRequest $request)
    {
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

        return response()->json([
            'message' => 'Détails du rôle récupérés avec succès.',
            'role' => $role
        ], 200);
    }





    public function update(UpdateRoleRequest $request, Role $role)
    {
        $data = $request->validated();
        $role->update($data);

        return response()->json([
            'message' => 'Rôle mis à jour avec succès.',
            'role' => $role
        ], 200);
    }





    public function destroy(Role $role)
    {
        //
    }
}
