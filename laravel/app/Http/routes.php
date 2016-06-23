<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'PaginasCtrl@home']);

Route::get('/sobre', ['as' => 'sobre', 'uses' => 'PaginasCtrl@sobre']);

Route::get('/contato', ['as' => 'contato', 'uses' => 'PaginasCtrl@contato']);

Route::resource('post', 'PostCtrl');

Route::post('post/{post}/edit', ['as' => 'post.auth.edit', 'uses' => 'PostCtrl@auth_edit']);