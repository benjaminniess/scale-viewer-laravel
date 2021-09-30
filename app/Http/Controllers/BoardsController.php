<?php

namespace App\Http\Controllers;

use App\Models\Board;

class BoardsController extends Controller {

	/**
	 * @return Board[]|\Illuminate\Database\Eloquent\Collection
	 */
	public function index() {

		return Board::all();
	}

	/**
	 * @param int $boardID
	 *
	 * @return Board
	 */
	public function show( int $boardID ) {
		return Board::find( $boardID );
	}
}
