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

Route::get('/', 'GuestController@welcome')->name('welcome');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    /*Task URLs*/
    Route::get('/personal/tasks', 'TaskController@index')->name('task.index');
    Route::view('/personal/tasks/add', 'task.task-add')->name('task.add');
    Route::post('/personal/tasks/add', 'TaskController@store')->name('task.save');

    /*Profile URLs*/
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::post('/profile', 'ProfileController@save')->name('profile.save');

    /*Expenses URLs*/
    Route::get('/personal/expenses', 'ExpenseController@index')->name('expense.index');
    Route::get('/personal/expense/stats', 'ExpenseController@stats')->name('expense.stats');

    /*Galleries and Images URLs*/
    Route::get('/personal/gallery', 'GalleryController@index')->name('gallery.index');
    Route::get('/personal/gallery/add', 'GalleryController@add')->name('gallery.add');
    Route::get('/personal/gallery/{gallery}', 'GalleryController@view')->name('gallery.view');

    Route::view('/personal/documents', 'documents.document-index')->name('document.index');
});

Route::get('test-s3', function () {
    return [
        'directories' => \Illuminate\Support\Facades\Storage::disk('s3')->directories('/albums'),
        'files' => \Illuminate\Support\Facades\Storage::disk('s3')->file('/'),
    ];
});
