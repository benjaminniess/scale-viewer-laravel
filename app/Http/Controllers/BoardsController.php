<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoard;
use App\Http\Requests\UpdateBoard;
use App\Number;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \App\Board;
use Auth;

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
        $user = Auth::user();

        $numbers = $board->numbers();

        return view('boards.show', [
            'board' => $board,
            'numbers' => $numbers,
            'edit_permalink' => $user && $user->is_author($board) ? $board->edit_permalink() : false,
        ]);
    }

    /**
     * Show the form for creating a new board.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('boards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBoard $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBoard $request)
    {
        $board = Board::store_board($request);
        return redirect( $board->permalink() );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Board $board
     * @return \Illuminate\Contracts\View\Factory
     */
    public function edit(Board $board)
    {
        $this->authorize('update', $board);

        return view('boards.edit', [
            'board' => $board,
            'back_permalink' => $board->permalink(),
            'numbers' => $board->numbers(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBoard $request
     * @param  \App\Board $board
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBoard $request, Board $board)
    {
        $this->authorize('update', $board);
        $board->update_board($request);
        return redirect( $board->permalink() );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store_number(Request $request, Board $board)
    {
        $this->authorize('update', $board);

        request()->validate([
            'new_number' => [ 'required', 'integer' ],
            'new_number_title' => 'required',
        ]);

        $number = new Number();
        $number->number = $request->new_number;
        $number->title = $request->new_number_title;
        $number->description = $request->new_number_description;
        $number->board_id = $board->id;
        $number->save();

        return redirect( $board->edit_permalink() );
    }
}
