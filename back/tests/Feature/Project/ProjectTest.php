<?php

namespace Tests\Feature\Project;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use DatabaseTransactions;

    public function test_example(): void
    {
        $response = $this->getJson( 'api/project');
        $response->assertStatus(200);
    }

    public function test_create_and_get()
    {
        $this->postJson('api/project', [
            'title' => 'test title',
            'directory' => app_path(),
        ]);
        $response = $this->json('get', 'api/project');
        $response->assertStatus(200);
    }
}
