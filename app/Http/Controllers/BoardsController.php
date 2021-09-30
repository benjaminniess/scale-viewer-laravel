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

	public function show( Board $board ) {
		return $board;
	}
}
