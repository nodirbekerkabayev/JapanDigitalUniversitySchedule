<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Room;
use App\Models\Subject;
use App\Models\User;
use Carbon\WeekDay;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject_id' => Subject::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'group_id' => Group::factory()->create()->id,
            'room_id' => Room::factory()->create()->id,
            'pair' => $this->faker->numberBetween(1, 10),
            'week_day' => $this->faker->randomElement(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']),
            'date' => $this->faker->date(),
        ];
    }
}
