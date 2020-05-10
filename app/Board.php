<?php

namespace App;

use App\Http\Requests\UpdateBoard;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $guarded = ['id'];

    public static $templates = [
        'default' => 'Default (Honrizontal display)',
        'vertical' => 'Vertical display',
        'dates' => 'Date ranges',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function numbers() {
        return $this->hasMany('\App\Number');
    }

    /**
     * Add a number to a board
     *
     * @param $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function add_number($attributes)
    {
        return $this->numbers()->create($attributes);
    }

    /**
     * @param \App\Http\Requests\UpdateBoard $request
     * @return bool
     */
    public function update_board(UpdateBoard $request)
    {
        $validated_data = $request->validated();

        return $this->update($validated_data);
    }
}
