<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Group;
use App\Services\GroupService;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $query = Group::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->get('search') . '%');
        }

        if ($request->has('sort') && in_array(strtolower($request->get('sort')), ['asc', 'desc'])) {
            $query->orderBy('created_at', $request->get('sort'));
        }

        $groups = $query->paginate($perPage);
        return response()->json($groups);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(GroupRequest $request)
    {
        $validator = $request->validated();
        Group::query()->create($validator);
        return response()->json(['message' => 'Group created successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupRequest $request)
    {
        $validator = $request->validated();
        $group = Group::query()->create($validator);
        return response()->json(['message' => 'Group created successfully.', 'group' => $group], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        return response()->json($group);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupRequest $request, Group $group)
    {
        $validator = $request->validated();
        $group->update($validator);
        return response()->json(['message' => 'Group updated successfully.']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $group->delete();
        return response()->json(['message' => 'Group deleted successfully.']);

    }
}
