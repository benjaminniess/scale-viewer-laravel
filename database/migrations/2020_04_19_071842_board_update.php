<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BoardUpdate extends Migration
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
                $table->bigInteger('author_id')
                      ->unsigned()
                      ->nullable();
                $table->foreign('author_id')
                      ->references('id')
                      ->on('users');
            });
        }

        if (!Schema::hasColumn('boards', 'status')) {
            Schema::table('boards', function (Blueprint $table) {
                $table->string('status', 50)
                      ->default('new');
            });
        }

        if (!Schema::hasColumn('boards', 'description')) {
            Schema::table('boards', function (Blueprint $table) {
                $table->text('description')
                      ->nullable();
            });
        }

        if (!Schema::hasColumn('boards', 'created_at')) {
            Schema::table('boards', function (Blueprint $table) {
                $table->dateTime('created_at')
                      ->default(now());
            });
        }

        if (!Schema::hasColumn('boards', 'updated_at')) {
            Schema::table('boards', function (Blueprint $table) {
                $table->dateTime('updated_at')
                      ->default(now());
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
        \App\Number::query()->delete();
        \App\Board::query()->delete();
        \App\User::query()->delete();

        if (Schema::hasColumn('boards', 'author_id')) {
            Schema::table('boards', function (Blueprint $table) {
                $table->dropForeign(['author_id']);
                $table->dropColumn('author_id');
            });
        }

        if (Schema::hasColumn('boards', 'status')) {
            Schema::table('boards', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }

        if (Schema::hasColumn('boards', 'description')) {
            Schema::table('boards', function (Blueprint $table) {
                $table->dropColumn('description');
            });
        }

        if (Schema::hasColumn('boards', 'created_at')) {
            Schema::table('boards', function (Blueprint $table) {
                $table->dropColumn('created_at');
            });
        }

        if (Schema::hasColumn('boards', 'updated_at')) {
            Schema::table('boards', function (Blueprint $table) {
                $table->dropColumn('updated_at');
            });
        }
    }
}
