<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Role::query();
        $perPage = $request->query('per_page', 10);
        $roles = $query->paginate($perPage);
        return response()->json($roles);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $validator = $request->validated();
        $role = Role::query()->create($validator);
        return response()->json(['message' => 'Role created successfully.', 'role' => $role], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $validator = $request->validated();
        $role = Role::query()->update($validator);
        return response()->json(['message' => 'Role updated successfully.', 'role' => $role], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['message' => 'Role deleted successfully.']);
    }
}
