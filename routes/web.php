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

Route::get('/browser/search', 'BookBrowserController@search')
    ->name('bookbrowser.search');

Route::get('/browser/{source?}', 'BookBrowserController@index')
    ->name('bookbrowser.index');

// Book viewer

Route::get('/viewer/{code}', 'BookViewerController@index')
    ->name('bookviewer.index');
Route::get('/viewer/{code}/msections/{msection}/msheets/{msheet}', 'BookViewerController@view')
    ->name('bookviewer.view');
Route::get('/viewer/{code}/msections/{msection}/msheets/{msheet}/next', 'BookViewerController@next')
    ->name('bookviewer.next');
Route::get('/viewer/{code}/msections/{msection}/msheets/{msheet}/previous', 'BookViewerController@previous')
    ->name('bookviewer.previous');
Route::get('/viewer/{code}/metadata', 'BookViewerController@metadata')
    ->name('bookviewer.metadata');

// Themes
 
Route::get('/themes/{theme}/styles', 'ThemeController@getStyles')
    ->name('themes.styles');

// Authentication

Auth::routes();

// Authentication required routes

Route::group(['middleware' => 'auth'], function() 
{
    // Home

    Route::get('/home', 'HomeController@index')->name('home');

    // mBooks

    Route::post('/mbooks/{mbook}/bookmark', 'MbookController@bookmark')
        ->name('mbooks.bookmark');

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
