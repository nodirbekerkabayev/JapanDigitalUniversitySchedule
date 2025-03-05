<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class GroupControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_list_groups()
    {
        Sanctum::actingAs(User::factory()->create());

        Group::factory()->count(5)->create();

        $response = $this->getJson('/api/groups');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data');
    }

    #[Test]
    public function it_can_create_a_group()
    {
        Sanctum::actingAs(User::factory()->create());

        $data = ['name' => 'php'];

        $response = $this->postJson('/api/groups', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['message' => 'Group created successfully.']);

        $this->assertDatabaseHas('groups', $data);
    }

    #[Test]
    public function it_can_show_a_group()
    {
        Sanctum::actingAs(User::factory()->create());

        $group = Group::factory()->create();

        $response = $this->getJson("/api/groups/{$group->id}");

        $response->assertStatus(200)
            ->assertJson(['id' => $group->id]);
    }

    #[Test]
    public function it_can_update_a_group()
    {
        Sanctum::actingAs(User::factory()->create());

        $group = Group::factory()->create();
        $updateData = ['name' => 'Updated Name'];

        $response = $this->putJson("/api/groups/{$group->id}", $updateData);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Group updated successfully.']);

        $this->assertDatabaseHas('groups', $updateData);
    }

    #[Test]
    public function it_can_delete_a_group()
    {
        Sanctum::actingAs(User::factory()->create());

        $group = Group::factory()->create();

        $response = $this->deleteJson("/api/groups/{$group->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Group deleted successfully.']);

        $this->assertDatabaseMissing('groups', ['id' => $group->id]);
    }
}
