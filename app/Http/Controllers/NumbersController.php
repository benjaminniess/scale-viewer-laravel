<?php

namespace App\Http\Controllers;

use App\Board;
use App\Http\Requests\UpdateNumber;
use App\Number;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNumber;

class NumbersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreNumber $request
     * @param Board $board
     */
    public function store(StoreNumber $request, Board $board)
    {
        $board->add_number([
            'title' => request('new_number_title'),
            'number' => request('new_number'),
            'description' => request('new_number_description'),
            'main_color' => request('new_number_main_color'),
            'url' => request('new_number_url'),
            'shortize' => 1 === (int) request('new_number_shortize'),
            'hide_number' => 1 === (int) request('new_number_hide_number'),
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Number  $number
     * @return \Illuminate\Http\Response
     */
    public function show(Number $number)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Board  $board
     * @param  \App\Number  $number
     * @return \Illuminate\Contracts\View\Factory
     */
    public function edit(Board $board, Number $number)
    {
        // TODO: Add policy class
        //$this->authorize('update', $number);

        return view('numbers.edit', [
            'number' => $number,
            'board' => $board,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNumber $request
     * @param  \App\Number  $number
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateNumber $request, Board $board, Number $number)
    {

        //TODO: Permissions check

        $request->validated();

        $number->update([
            'number' => $request->update_number,
            'title' => $request->update_number_title,
            'description' => $request->update_number_description,
            'main_color' => $request->update_number_main_color,
            'url' => $request->update_number_url,
            'shortize' => (int) $request->update_number_shortize,
            'hide_number' => (int) $request->update_number_hide_number,
        ]);

        return redirect(route('edit_board', $board->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Number  $number
     * @return \Illuminate\Http\Response
     */
    public function destroy(Number $number)
    {
        //
    }
}
