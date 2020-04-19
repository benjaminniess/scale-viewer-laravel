<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
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
}
