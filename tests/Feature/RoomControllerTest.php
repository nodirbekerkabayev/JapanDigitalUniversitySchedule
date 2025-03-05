<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class RoomControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_list_rooms()
    {
        Sanctum::actingAs(User::factory()->create());

        Room::factory()->count(5)->create();

        $response = $this->getJson('/api/rooms');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data');
    }

    #[Test]
    public function it_can_create_a_room()
    {
        Sanctum::actingAs(User::factory()->create());

        $data = ['name' => 'n3'];

        $response = $this->postJson('/api/rooms', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['message' => 'Room created successfully.']);

        $this->assertDatabaseHas('rooms', $data);
    }

    #[Test]
    public function it_can_show_a_room()
    {
        Sanctum::actingAs(User::factory()->create());

        $group = Room::factory()->create();

        $response = $this->getJson("/api/rooms/{$group->id}");

        $response->assertStatus(200)
            ->assertJson(['id' => $group->id]);
    }

    #[Test]
    public function it_can_update_a_room()
    {
        Sanctum::actingAs(User::factory()->create());

        $room = Room::factory()->create();
        $updateData = ['name' => 'Updated Name'];

        $response = $this->putJson("/api/rooms/{$room->id}", $updateData);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Room updated successfully.']);

        $this->assertDatabaseHas('rooms', $updateData);
    }

    #[Test]
    public function it_can_delete_a_room()
    {
        Sanctum::actingAs(User::factory()->create());

        $room = Room::factory()->create();

        $response = $this->deleteJson("/api/rooms/{$room->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Room deleted successfully.']);

        $this->assertDatabaseMissing('rooms', ['id' => $room->id]);
    }
}
