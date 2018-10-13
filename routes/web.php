<?php

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

// Frontpage

Route::get('/', function () {
    return view('welcome');
});

// Authentication

Auth::routes();

// Home

Route::get('/home', 'HomeController@index')->name('home');

// mBooks

Route::resource('mbooks', 'MbookController');

// mSections

Route::get('/mbooks/{mbook}/msections/{msection}/moveUp', 'MsectionController@moveUp')
    ->name('mbooks.msections.moveUp');
Route::get('/mbooks/{mbook}/msections/{msection}/moveDown', 'MsectionController@moveDown')
    ->name('mbooks.msections.moveDown');

Route::resource('mbooks.msections', 'MsectionController');

// mSheets 

Route::get('/mbooks/{mbook}/msections/{msection}/msheets/{msheet}/moveUp', 'MsheetController@moveUp')
    ->name('mbooks.msections.msheets.moveUp');
Route::get('/mbooks/{mbook}/msections/{msection}/msheets/{msheet}/moveDown', 'MsheetController@moveDown')
    ->name('mbooks.msections.msheets.moveDown');

Route::resource('mbooks.msections.msheets', 'MsheetController');
