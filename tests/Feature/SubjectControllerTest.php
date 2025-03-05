<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class SubjectControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_list_subjects()
    {
        Sanctum::actingAs(User::factory()->create());

        Subject::factory()->count(5)->create();

        $response = $this->getJson('/api/subjects');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data');
    }

    #[Test]
    public function it_can_create_a_subject()
    {
        Sanctum::actingAs(User::factory()->create());

        $data = ['name' => 'Matematika'];

        $response = $this->postJson('/api/subjects', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['message' => 'Subject created successfully.']);

        $this->assertDatabaseHas('subjects', $data);
    }

    #[Test]
    public function it_can_show_a_subject()
    {
        Sanctum::actingAs(User::factory()->create());

        $subject = Subject::factory()->create();

        $response = $this->getJson("/api/subjects/{$subject->id}");

        $response->assertStatus(200)
            ->assertJson(['id' => $subject->id]);
    }

    #[Test]
    public function it_can_update_a_subject()
    {
        Sanctum::actingAs(User::factory()->create());

        $subject = Subject::factory()->create();
        $updateData = ['name' => 'Updated Name'];

        $response = $this->putJson("/api/subjects/{$subject->id}", $updateData);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Subject updated']);

        $this->assertDatabaseHas('subjects', $updateData);
    }

    #[Test]
    public function it_can_delete_a_subject()
    {
        Sanctum::actingAs(User::factory()->create());

        $subject = Subject::factory()->create();

        $response = $this->deleteJson("/api/subjects/{$subject->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Subject deleted']);

        $this->assertDatabaseMissing('subjects', ['id' => $subject->id]);
    }
}
