<?php

namespace App;

use App\Http\Requests\StoreBoard;
use App\Http\Requests\UpdateBoard;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function numbers() {
        return $this->hasMany( '\App\Number' )->get();
    }

    /**
     * Generates a permalink for the current board
     *
     * @return string
     */
    public function permalink() {
        return '/board/' . $this->id;
    }

    /**
     * Generates the edit permalink
     * @return string
     */
    public function edit_permalink() {
        return $this->permalink() . '/edit/';
    }

    /**
     * @param \App\Http\Requests\UpdateBoard $request
     * @return \App\Board $board
     */
    public function update_board(UpdateBoard $request)
    {
        $validated_data = $request->validated();
        $board = $this->update($validated_data);
        return $board;
    }
}
