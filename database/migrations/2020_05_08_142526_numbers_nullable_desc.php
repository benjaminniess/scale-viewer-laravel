<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NumbersNullableDesc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('numbers', 'description')) {
            Schema::table('numbers', function (Blueprint $table) {
                $table->text('description')
                      ->nullable()
                      ->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('numbers', 'description')) {
            Schema::table('numbers', function (Blueprint $table) {
                $table->text('description')
                    ->change();
            });
        }
    }
}
