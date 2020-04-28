<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $boards = \App\Board::all();

    return view('welcome', [
        'boards' => $boards,
    ]);
});

Route::get('/board/create', 'BoardsController@create')->middleware('auth');
Route::get('/board/{board}', 'BoardsController@show');
Route::get('/board/{board}/edit', 'BoardsController@edit')->middleware('auth');

Route::post('/board', 'BoardsController@store')->middleware('auth');
Route::put('/board/{board}', 'BoardsController@update')->middleware('auth');

Route::post('/board/{board}/numbers', 'BoardsController@store_number')->middleware('auth');

Route::get('google-connect', 'GoogleConnectController');

Auth::routes();
