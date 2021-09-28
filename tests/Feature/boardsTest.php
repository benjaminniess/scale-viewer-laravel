<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Board;

class boardsTest extends TestCase
{
    use RefreshDatabase;

    public function test_empty_boards_list()
    {
        $response = $this->get('/api/boards');

        $response->assertStatus(200)->assertExactJson([]);
    }

    public function test_boards_list()
    {
        $boards = Board::factory()
            ->count(3)
            ->create();

        $response = $this->get('/api/boards');

        $response
            ->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonStructure([
                [
                    'id',
                    'title',
                    'author_id',
                    'status',
                    'description',
                    'created_at',
                    'updated_at',
                    'template',
                ],
            ]);
    }
}
