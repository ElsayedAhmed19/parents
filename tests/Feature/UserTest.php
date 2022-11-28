<?php

namespace Tests\Feature;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_users_all_api_request()
    {
        $response = $this->getJson('/api/v1/users');

        $response->assertStatus(200);
    }

    public function test_users_api_otal_count_request()
    {
        $response = $this->getJson('/api/v1/users');

        $response->assertJson(fn (AssertableJson $json) =>
            $json->hasAll(['status', 'data'])
                ->has('data', 15000)
        );
    }

    // TODO: cover all test cases of query string
}
