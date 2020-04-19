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

        $numbers = $board->numbers();

        return view('boards.show', [
            'board' => $board,
            'numbers' => $numbers,
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
        if (empty($user)) {
            abort(403, 'You must be logged.');
        }

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
}
