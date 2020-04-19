<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuestonAuthors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('boards', 'author_id')) {
            Schema::table('boards', function (Blueprint $table) {
                $table->bigInteger('author_id')->unsigned();
            });
        }

        Schema::table('boards', function (Blueprint $table) {
            $table->foreign('author_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('boards', 'author_id')) {
            Schema::table('boards', function (Blueprint $table) {
                $table->dropForeign(['author_id']);
                $table->dropColumn('author_id');
            });
        }
    }
}
