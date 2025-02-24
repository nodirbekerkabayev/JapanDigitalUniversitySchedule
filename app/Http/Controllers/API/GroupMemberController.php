<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'group_id' => 'required|exists:groups,id',
            'user_id' => 'required|exists:rooms,id',
        ]);

        $group = Group::query()->findOrFail($request->get($validator["group_id"]));
        $group->users()->attach($request->get('user_id'));
        return response()->json(['message' => 'User successfully added to group.']);
    }

    /**
     * Display the specified resource.
     */
    public function show($group_id, $user_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $group_id, $user_id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $validator = $request->validate([
            'group_id' => 'required|exists:groups,id',
            'user_id' => 'required|exists:rooms,id',
        ]);
        $group = Group::query()->findOrFail($validator["group_id"]);
        $group->users()->detach();
        $group->delete();
        return response()->json(['message' => 'User successfully removed from group.']);
    }
}
