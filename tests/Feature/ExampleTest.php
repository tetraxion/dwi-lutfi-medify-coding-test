<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;

    public function test_the_application_returns_a_successful_response()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/master-items');

        $response->assertStatus(200);
    }
}
