<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Board;

class boardsTest extends TestCase {
	use RefreshDatabase;

	public function test_empty_boards_list(): void {
		$response = $this->get( '/api/boards' );

		$response->assertStatus( 200 )->assertExactJson( [] );
	}

	public function test_boards_list(): void {
		Board::factory()
		     ->count( 3 )
		     ->create();

		$response = $this->get( '/api/boards' );

		$response
			->assertStatus( 200 )
			->assertJsonCount( 3 )
			->assertJsonStructure( [
				$this->getJsonStructure(),
			] );
	}

	public function test_single_board(): void {
		$board = Board::factory()
		              ->state( [
			              'title' => 'The board title',
		              ] )
		              ->create();

		$response = $this->get( '/api/boards/' . $board->id );

		$response
			->assertStatus( 200 )
			->assertJsonStructure( $this->getJsonStructure() )
			->assertJsonFragment( [ 'title' => 'The board title' ] );
	}

	public function test_non_existing_single_board(): void {
		$response = $this->get( '/api/boards/1' );

		$response
			->assertStatus( 404 );
	}

	public function test_board_store_with_no_data(): void {
		$user = User::factory()->create();

		$response = $this->actingAs( $user )->postJson( '/api/boards' );

		$response->assertJsonPath( 'errors.title', [ 'Please give the board a name' ] );
		$response->assertJsonPath( 'errors.description', [ 'Please give the board a description' ] );

		$response->assertStatus( 422 );
	}

	public function test_board_store_with_correct_values(): void {
		$user = User::factory()->create();

		$response = $this->actingAs( $user )->postJson( '/api/boards', [
			'title'       => 'My board test',
			'description' => 'My board description'
		] );
		// First assertion on form success status
		$response->assertStatus( 201 );

		$stored_check_response = $this->get( '/api/boards' );

		// Extra check to make sure the data has been saved
		$stored_check_response
			->assertStatus( 200 )
			->assertJsonStructure( [
				$this->getJsonStructure(),
			] )->assertJsonFragment( [ 'title' => 'My board test', 'author_id' => strval( $user->id ) ] );
	}

	/**
	 * The awaited object structure
	 *
	 * @return string[]
	 */
	private function getJsonStructure(): array {
		return [
			'id',
			'title',
			'author_id',
			'status',
			'description',
			'created_at',
			'updated_at',
			'template',
		];
	}

}
