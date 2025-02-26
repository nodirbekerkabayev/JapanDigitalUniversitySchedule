<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Models\Group;
use App\Models\Room;
use App\Services\RoomService;
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

        if ($request->has('sort') && in_array(strtolower($request->get('sort')), ['asc', 'desc'])) {
            $query->orderBy('created_at', $request->get('sort'));
        }

        $rooms = $query->paginate($perPage);
        return response()->json($rooms);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(RoomRequest $request)
    {
        $validator = $request->validated();
        Room::query()->create($validator);
        return response()->json(['message' => 'Room created successfully.']);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomRequest $request)
    {
        $validator = $request->validated();
        $room = Room::query()->create($validator);
        return response()->json(['message' => 'Room created successfully.', 'room' => $room], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return response()->json($room);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomRequest $request, Room $room)
    {
        $validator = $request->validated();
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
