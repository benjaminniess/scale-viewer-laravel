<?php

namespace App\Http\Controllers;

use App\Board;
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
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(StoreNumber $request, Board $board)
    {
        $board->add_number([
            'title'       => request('new_number_title'),
            'number'      => request('new_number'),
            'description' => request('new_number_description')
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
     * @param  \App\Number  $number
     * @return \Illuminate\Http\Response
     */
    public function edit(Number $number)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Number  $number
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Number $number)
    {
        //
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
