<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validator = $request->validate([
            'subject_id' => 'required',
            'user_id' => 'required',
        ]);
        $user = User::query()->findOrFail($request->get($validator["user_id"]));
        $user->subjects()->attach($request->get('subject_id'));
        return response()->json(['message' => 'Subject teacher successfully assigned.']);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $validator = $request->validate([
            'user_id' => 'required',
            'subject_id' => 'required',
        ]);
        $user = User::query()->findOrFail($validator["user_id"]);
        $user->subjects()->detach();
        $user->delete();
        return response()->json(['message' => 'Subject teacher successfully removed.']);

    }
}
