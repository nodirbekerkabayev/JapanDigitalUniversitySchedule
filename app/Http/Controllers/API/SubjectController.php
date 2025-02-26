<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use App\Services\SubjectService;
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
        if ($request->has('sort') && in_array(strtolower($request->get('sort')), ['asc', 'desc'])) {
            $query->orderBy('created_at', $request->get('sort'));
        }

        $subjects = $query->paginate($perPage);
        return response()->json($subjects);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(SubjectRequest $request)
    {
        $validator = $request->validated();
        Subject::query()->create($validator);
        return response()->json(['message' => 'Subject created']);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        $validator = $request->validated();
        $subject = Subject::query()->create($validator);
        return response()->json(['message' => 'Subject created successfully.', 'subject' => $subject], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return response()->json($subject);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
        $validator = $request->validated();
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
