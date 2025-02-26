<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupSubjectRequest;
use App\Models\Group;
use App\Services\GroupSubjectService;
use Illuminate\Http\Request;

class GroupSubjectController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupSubjectRequest $request)
    {
        $validator = $request->validated();

        $group = Group::query()->find($validator["group_id"]);
        $group->subjects()->attach($request->get('subject_id'));
        return response()->json(['message' => 'Subject added successfully.']);
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
    public function destroy(GroupSubjectRequest $request, string $id)
    {
        $validator = $request->validated();

        $group = Group::query()->find($validator["group_id"]);
        $group->subjects()->detach();
        $group->delete();
        return response()->json(['message' => 'Subject successfully removed.']);
    }
}
