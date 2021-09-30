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

Route::get( '/', function () {
	$boards = \App\Models\Board::all();

	return view( 'welcome', [
		'boards' => $boards,
	] );
} )->name( 'home' );

Route::get( '/board/create', 'BoardsController@create' )
     ->middleware( 'auth' )
     ->name( 'create_board' );

Route::get( '/board/{board}/edit', 'BoardsController@edit' )
     ->middleware( 'auth' )
     ->name( 'edit_board' );

Route::post( '/board', 'BoardsController@store' )
     ->middleware( 'auth' )
     ->name( 'store_board' );
Route::put( '/board/{board}', 'BoardsController@update' )
     ->middleware( 'auth' )
     ->name( 'update_board' );

Route::post( '/board/{board}/numbers', 'NumbersController@store' )
     ->middleware( 'auth' )
     ->name( 'store_number' );
Route::get( '/board/{board}/numbers/{number}/edit', 'NumbersController@edit' )
     ->middleware( 'auth' )
     ->name( 'edit_number' );
Route::put( '/board/{board}/numbers/{number}', 'NumbersController@update' )
     ->middleware( 'auth' )
     ->name( 'update_number' );

Auth::routes();
