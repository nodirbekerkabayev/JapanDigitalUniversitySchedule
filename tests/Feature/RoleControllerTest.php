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
}
