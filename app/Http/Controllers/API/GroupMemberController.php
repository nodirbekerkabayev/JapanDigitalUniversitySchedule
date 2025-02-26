<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupMemberRequest;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupMemberController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupMemberRequest $request)
    {
        $validator = $request->validated();

        $group = Group::query()->findOrFail(request()->get($validator["group_id"]));
        $group->users()->attach(request()->get('user_id'));
        return response()->json(['message' => 'User successfully added to group.']);
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
    public function destroy(GroupMemberRequest $request)
    {
        $validator = $request->validated();
        $group = Group::query()->findOrFail($validator["group_id"]);
        $group->users()->detach();
        $group->delete();
        return response()->json(['message' => 'User successfully removed from group.']);
    }
}
