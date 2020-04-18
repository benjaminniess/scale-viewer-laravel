<?php

namespace App\Http\Controllers;

use \App\Board;

class BoardsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Board $board
     * @return \Illuminate\Contracts\View\Factory
     */
    public function show(Board $board)
    {

        $numbers = $board->numbers();

        return view('boards.show', [
            'board' => $board,
            'numbers' => $numbers,
        ]);
    }
}
