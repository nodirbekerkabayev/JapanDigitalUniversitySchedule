<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class RoleControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function it_can_show_all_roles()
    {
        Sanctum::actingAs(User::factory()->create());

        Role::factory()->count(3)->create();

        $response = $this->getJson("/api/roles");

        $response->assertStatus(200);

        $response->assertJsonStructure([
            "data" => [
                "*" => ["id", "role", "created_at", "updated_at"]
            ],
            "links"
        ]);
    }

    #[Test]
    public function it_can_store_roles()
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson("/api/roles", [
            "role" => "admin"
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('roles', [
            'role' => 'admin'
        ]);

        $response->assertJson([
            'message' => 'Role created successfully.',
            'role' => [
                'id' => $response['role']['id'],
                'role' => 'admin',
                'created_at' => $response['role']['created_at'],
                'updated_at' => $response['role']['updated_at'],
            ]
        ]);
    }

    #[Test]
    public function it_can_update_roles()
    {
        Sanctum::actingAs(User::factory()->create());
        $role = Role::factory()->create();
        $response = $this->putJson("/api/roles/{$role->id}", [
            "role" => "admin"
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('roles', [
            'role' => 'admin'
        ]);
        $response->assertJson([
            'message' => 'Role updated successfully.',
            'role' => 1
        ]);
    }
}
