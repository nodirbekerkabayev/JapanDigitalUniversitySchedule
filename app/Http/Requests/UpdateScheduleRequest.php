<?php

namespace App\Http\Requests;

use App\Models\Schedule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $schedule = $this->route('schedule');
        if (is_string($schedule)) {
            $schedule = Schedule::query()->find($schedule);
        }

        return [
            'subject_id' => 'required|exists:subjects,id',
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('schedules', 'user_id')->where(fn($query) => $query->where('pair', $this->input('pair'))
                    ->where('week_day', $this->input('week_day'))->where('date', $this->input('date')))
                    ->ignore($schedule?->id),
            ],
            'group_id' => [
                'required',
                'exists:groups,id',
                Rule::unique('schedules', 'group_id')->where(fn($query) => $query->where('pair', $this->input('pair'))
                    ->where('week_day', $this->input('week_day'))->where('date', $this->input('date')))
                    ->ignore($schedule?->id),
            ],
            'room_id' => [
                'required',
                'exists:rooms,id', // ✅ `groups,id` emas, `rooms,id`
                Rule::unique('schedules', 'room_id')->where(fn($query) => $query->where('pair', $this->input('pair'))
                    ->where('week_day', $this->input('week_day'))->where('date', $this->input('date')))
                    ->ignore($schedule?->id),
            ],
            'pair' => 'required|integer|between:1,7',
            'week_day' => 'required|string|in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
            'date' => 'required|date',
        ];
    }
}
