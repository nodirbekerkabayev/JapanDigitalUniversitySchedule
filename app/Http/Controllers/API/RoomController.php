<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Room::query();
        $perPage = $request->get('per_page', 10);

        if($request->has('search')) {
            $query->where('name', 'like', '%' . $request->get('search') . '%');
        }

        if ($request->has('sort_by_date')) {
            $query->where('created_at', 'like', '%' . $request->get('sort_by_date') . '%');
            $query->orderByDesc('created_at');
        }

        $rooms = $query->paginate($perPage);
        return response()->json($rooms);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
        ]);
        Room::query()->create($validator);
        return response()->json(['message' => 'Room created successfully.']);

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
    public function show(Room $room)
    {
        return response()->json($room);
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
    public function update(Request $request, Room $room)
    {
        $validator = $request->validate([
            'name' => 'required',
        ]);
        $room->update($validator);
        return response()->json(['message' => 'Room updated successfully.']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json(['message' => 'Group deleted successfully.']);

    }
}
