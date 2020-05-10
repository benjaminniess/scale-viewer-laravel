<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('boards', 'template')) {
            Schema::table('boards', function (Blueprint $table) {
                $table->string('template', 100)
                      ->nullable();
            });
        }

        if (!Schema::hasColumn('numbers', 'main_color')) {
            Schema::table('numbers', function (Blueprint $table) {
                $table->string('main_color', 30)
                      ->nullable();
            });
        }

        if (!Schema::hasColumn('numbers', 'url')) {
            Schema::table('numbers', function (Blueprint $table) {
                $table->text('url')
                      ->nullable();
            });
        }

        if (!Schema::hasColumn('numbers', 'shortize')) {
            Schema::table('numbers', function (Blueprint $table) {
                $table->boolean('shortize')
                      ->default(false);
            });
        }

        if (!Schema::hasColumn('numbers', 'hide_number')) {
            Schema::table('numbers', function (Blueprint $table) {
                $table->boolean('hide_number')
                      ->default(false);
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
        if (Schema::hasColumn('boards', 'template')) {
            Schema::table('boards', function (Blueprint $table) {
                $table->dropColumn('template');
            });
        }

        if (Schema::hasColumn('numbers', 'main_color')) {
            Schema::table('numbers', function (Blueprint $table) {
                $table->dropColumn('main_color');
            });
        }

        if (Schema::hasColumn('numbers', 'url')) {
            Schema::table('numbers', function (Blueprint $table) {
                $table->dropColumn('url');
            });
        }

        if (Schema::hasColumn('numbers', 'shortize')) {
            Schema::table('numbers', function (Blueprint $table) {
                $table->dropColumn('shortize');
            });
        }

        if (Schema::hasColumn('numbers', 'hide_number')) {
            Schema::table('numbers', function (Blueprint $table) {
                $table->dropColumn('hide_number');
            });
        }
    }
}
