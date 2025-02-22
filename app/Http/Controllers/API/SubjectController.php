<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $query = Subject::query();

        if($request->has('search')) {
            $query->where('name', 'like', '%' . $request->get('search') . '%');
        }
        if($request->has('sort_by_date')) {
            $query->where('created_at', '>=', $request->get('sort_by_date'));
            $query->orderBy('created_at', 'DESC');
        }

        $subjects = $query->paginate($perPage);
        return response()->json($subjects);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
        ]);
        Subject::query()->create($validator);
        return response()->json(['message' => 'Subject created']);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return response()->json($subject);
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
    public function update(Request $request, Subject $subject)
    {
        $validator = $request->validate([
            'name' => 'required',
        ]);
        $subject->update($validator);
        return response()->json(['message' => 'Subject updated']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return response()->json(['message' => 'Subject deleted']);
    }
}
