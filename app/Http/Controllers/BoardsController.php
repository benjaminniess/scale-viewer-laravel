<?php

namespace App\Http\Controllers;

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
            'edit_permalink' => ! empty( $user ) && $user->id === $board->author_id ? $board->edit_permalink() : false,
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        request()->validate([
            'title' => [ 'required' ],
            'description' => [ 'required' ],
        ]);

        $board = new Board();
        $board->title = $request->title;
        $board->author_id = $user->id;
        $board->status = 'new';
        $board->description = $request->description;
        $board->created_at = Carbon::now();
        $board->updated_at = Carbon::now();
        $board->save();

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
        $user = Auth::user();
        if ( $user->id !== $board->author_id ) {
            abort(403, "You can't edit this board");
        }

        return view('boards.edit', [
            'board' => $board,
            'back_permalink' => $board->permalink()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Board $board
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Board $board)
    {
        $user = Auth::user();
        if ( $user->id !== $board->author_id ) {
            abort(403, "You can't edit this board");
        }

        request()->validate([
            'title' => [ 'required' ],
            'description' => [ 'required' ],
        ]);
        $board->title = $request->title;
        $board->description = $request->description;
        $board->save();

        return redirect( $board->permalink() );
    }
}
