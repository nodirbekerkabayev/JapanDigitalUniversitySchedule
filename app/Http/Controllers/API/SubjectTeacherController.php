<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectTeacherRequest;
use App\Models\Group;
use App\Models\Subject;
use App\Models\User;
use App\Services\SubjectTeacherService;
use Illuminate\Http\Request;

class SubjectTeacherController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function index(SubjectTeacherRequest $request)
    {
        $validator = $request->validated();
        $user = User::query()->findOrFail($request->get($validator["user_id"]));
        $user->subjects()->attach($request->get('subject_id'));
        return response()->json(['message' => 'Subject teacher successfully assigned.']);
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
    public function destroy(SubjectTeacherRequest $request, string $id)
    {
        $validator = $request->validated();
        $user = User::query()->findOrFail($validator["user_id"]);
        $user->subjects()->detach();
        $user->delete();
        return response()->json(['message' => 'Subject teacher successfully removed.']);

    }
}
