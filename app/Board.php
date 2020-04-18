<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    public function numbers() {
        return $this->hasMany( '\App\Number' )->get();
    }
}
