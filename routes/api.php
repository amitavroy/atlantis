<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('tasks/delete', 'TaskController@remove')->name('task.delete');
    Route::post('tasks/comment', 'TaskCommentController@store')->name('task-comment.add');
    Route::get('site/monitor', 'SiteMonitorController@index')->name('site-monitor.index');
    Route::get('expenses/categories', 'CategoryController@index');
    
    Route::post('expenses', 'ExpenseController@store');
    
    Route::post('/personal/gallery/add', 'GalleryController@store')->name('gallery.save');
    Route::post('/personal/gallery/image-add', 'GalleryImageController@add')->name('gallery.add-images');

    Route::post('/document/list', 'DocumentController@index')->name('document.index');
    Route::get('/document/download', 'DocumentController@view')->name('document.download');
    Route::post('/document/upload', 'DocumentController@store')->name('document.upload');
    Route::post('/document/delete', 'DocumentController@delete')->name('document.delete');

    Route::get('git-projects/list', 'GitProjectController@list')->name('gitproject.list');
});
