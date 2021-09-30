<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoard;
use App\Http\Requests\UpdateBoard;
use App\Models\Board;
use Auth;

class BoardsController extends Controller {

	/**
	 * @return Board[]|\Illuminate\Database\Eloquent\Collection
	 */
	public function index() {

		return Board::all();
	}


	public function show( int $boardID ) {
		return Board::find( $boardID );
	}

	/**
	 * Show the form for creating a new board.
	 *
	 * @return \Illuminate\Contracts\View\Factory
	 */
	public function create() {
		return view( 'boards.create', [
			'templates' => \App\Models\Board::$templates,
		] );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \App\Http\Requests\StoreBoard $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store( StoreBoard $request ) {
		$board = Board::create( [
			'title'       => request( 'title' ),
			'description' => request( 'description' ),
			'author_id'   => auth()->user()->id,
			'status'      => 'new',
			'template'    => request( 'template' ),
		] );

		return redirect( route( 'show_board', $board->id ) );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param Board $board
	 *
	 * @return \Illuminate\Contracts\View\Factory
	 */
	public function edit( Board $board ) {
		$this->authorize( 'update', $board );

		return view( 'boards.edit', [
			'board'          => $board,
			'back_permalink' => route( 'show_board', $board->id ),
			'numbers'        => $board->numbers()->get(),
			'template'       => $board->template,
			'templates'      => \App\Models\Board::$templates,
		] );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \App\Http\Requests\UpdateBoard $request
	 * @param \App\Models\Board $board
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update( UpdateBoard $request, Board $board ) {
		$this->authorize( 'update', $board );
		$board->update_board( $request );

		return redirect( route( 'show_board', $board->id ) );
	}
}
