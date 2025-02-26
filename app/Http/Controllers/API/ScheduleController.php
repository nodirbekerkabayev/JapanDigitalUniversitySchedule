<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = 7;
        $schedule = Schedule::query()->paginate($perPage);
        return response()->json($schedule);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScheduleRequest $request)
    {
        $validated = $request->validated();
        $schedule = Schedule::query()
            ->where('subject_id', $validated['subject_id'])
            ->where('user_id', $validated['user_id'])
            ->where('group_id', $validated['group_id'])
            ->where('room_id', $validated['room_id'])
            ->where('pair', $validated['pair'])
            ->where('week_day', $validated['week_day'])
            ->where('date', $validated['date'])
            ->first();
        if ($schedule) {
            return response()->json(['message'=>'Schedule already exists.'], 400);
        }
        Schedule::query()->create($validated);
        return response()->json(['message' => 'Schedule created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        return response()->json($schedule);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScheduleRequest $request, $id)
    {
        $validated = $request->validated();

        $schedule = Schedule::query()->findOrFail($id); // ID bo‘yicha modelni topamiz

        $schedule->update($validated); // Shu modelni yangilaymiz

        return response()->json(['message' => 'Schedule updated successfully.']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return response()->json(['message' => 'Schedule deleted successfully.']);
    }
}
