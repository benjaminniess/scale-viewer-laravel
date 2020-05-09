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

        $numbers = $board->numbers()->orderBy('number', 'asc')->get();

        // The size of the minimum legend square
        $minimumScaleWidth = 4;

        // The height limit the number can reach
        $maximumScaleHeight = 400;

        // Prepare a value to store the minimum number for the legend
        $referenceIndex = 0;
        $numbers_data = [];
        foreach ($numbers as $row => $number) {
            $numbers_data[$row] = [
                'number' => $number->number,
                'title' => $number->title,
                'description' => $number->description,
                'extraData' => [],
            ];

            // First row is for the legend. Set it the size of the minimum square
            if (0 === $row) {
                $referenceIndex = $number->number;
                $numbers_data[$row]['extraData']['css']['width'] = $minimumScaleWidth . 'px';
                $numbers_data[$row]['extraData']['css']['height'] = $minimumScaleWidth . 'px';
            } else {
                // Calculate the area of the square
                $square_value = ceil($number->number * pow($minimumScaleWidth, 2) / $referenceIndex);

                // Get the square root to guess the width
                $scaleNumber = (int) sqrt($square_value);
                if ($scaleNumber <= $maximumScaleHeight) {
                    $numbers_data[$row]['extraData']['css']['width'] = $scaleNumber . 'px';
                    $numbers_data[$row]['extraData']['css']['height'] = $scaleNumber . 'px';
                } else {
                    // If the max height is reached, block it and adjust width
                    $numbers_data[$row]['extraData']['css']['width'] = ceil($square_value / $maximumScaleHeight) . 'px';
                    $numbers_data[$row]['extraData']['css']['height'] = $maximumScaleHeight . 'px';
                }
            }
        }

        return view('boards.show', [
            'board' => $board,
            'numbers' => $numbers_data,
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
        $board = Board::create([
            'title'       => request('title'),
            'description' => request('description'),
            'author_id'   => auth()->user()->id,
            'status'      => 'new'
        ]);
        return redirect($board->permalink());
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
            'numbers' => $board->numbers()->get()
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
        return redirect($board->permalink());
    }
}
