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
    return redirect(route('bookbrowser.index'));
});

// Book browser

Route::get('/browser/{source?}', 'BookBrowserController@index')
    ->name('bookbrowser.index');

// Book viewer

Route::get('/viewer/{id}', 'BookViewerController@index')
    ->name('bookviewer.index');
Route::get('/viewer/{id}/metadata', 'BookViewerController@metadata')
    ->name('bookviewer.metadata');

// Authentication

Auth::routes();

// Authentication required routes

Route::group(['middleware' => 'auth'], function() 
{
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
});

// Non-authenticated routes
