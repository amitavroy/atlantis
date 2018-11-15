<?php

use Illuminate\Http\Request;

Route::get('/', 'GuestController@welcome')->name('welcome');

Auth::routes(['verify' => true]);

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

    /*Documents*/
    Route::view('/personal/documents', 'documents.document-index')->name('document.index');

    /*Github Project URLs*/
    Route::get('/personal/git-projects', 'GitProjectController@index')->name('github.list');

    /*Reminders*/
    Route::get('/personal/reminders', 'ReminderController@index')->name('reminder.index');
    Route::post('/personal/reminder/save', 'ReminderController@store')->name('reminder.save');
});

Route::post('upload', function (Request $request) {

});
