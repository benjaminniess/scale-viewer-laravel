<?php

namespace App;

use App\Http\Requests\StoreBoard;
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
     * Store a board in database
     * @param StoreBoard $request
     * @return \App\Board
     */
    static function store_board(StoreBoard $request)
    {
        $validated_data = $request->validated();
        $validated_data['author_id'] = auth()->user()->id;
        $validated_data['status'] = 'new';

        return $board = self::create($validated_data);
    }
}
