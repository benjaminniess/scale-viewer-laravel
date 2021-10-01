<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoard;
use App\Models\Board;

class BoardsController extends Controller {

	/**
	 * @return Board[]|\Illuminate\Database\Eloquent\Collection
	 */
	public function index() {

		return Board::all();
	}

	public function show( Board $board ) {
		return $board;
	}

	/**
	 * @param StoreBoard $request
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function store( StoreBoard $request ) {
		Board::create( [
			'title'       => request( 'title' ),
			'description' => request( 'description' ),
			'author_id'   => auth()->user()->id,
			'status'      => 'new',
			'template'    => request( 'template' ),
		] );

		return response( 'Board created', 201 );
	}
}
