<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleUserRequest;
use App\Models\User;
use App\Services\RoleUserService;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleUserRequest $request)
    {
        $validator = $request->validated();
        $user = User::query()->find($validator['user_id']);
        $user->roles()->attach($request->get('role_id'));
        return response()->json(['message' => 'Role added successfully.']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoleUserRequest $request)
    {
        $validator = $request->validated();
        $user = User::query()->find($validator['user_id']);
        $user->roles()->detach();
        $user->delete();
        return response()->json(['message' => 'Role deleted successfully.']);
    }
}
