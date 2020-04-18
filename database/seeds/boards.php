<?php

use Illuminate\Database\Seeder;

class boards extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('boards')->insert([
            'title' => "Prices scale",
        ]);

        $price_board = \App\Board::orderBy('id', 'desc')->first();

        DB::table('boards')->insert([
            'title' => "What do we die from?",
        ]);
        $die_board = \App\Board::orderBy('id', 'desc')->first();

        DB::table('numbers')->insert([
            'title' => "French debt",
            'number' => 2358000000,
            'description' => '2022 French debt value',
            'board_id' => $price_board->id
        ]);

        DB::table('numbers')->insert([
            'title' => "French GDP",
            'number' => 2353000000,
            'description' => '2019 French Gross Domestic Product',
            'board_id' => $price_board->id
        ]);

        DB::table('numbers')->insert([
            'title' => "Aids in 2019",
            'number' => 770000,
            'description' => 'Number of deaths due to AIDS in 2019',
            'board_id' => $die_board->id
        ]);

        DB::table('numbers')->insert([
            'title' => "Coronavirus",
            'number' => 160000,
            'description' => 'Number of deaths due to coronavirus in 2020',
            'board_id' => $die_board->id
        ]);
    }
}
