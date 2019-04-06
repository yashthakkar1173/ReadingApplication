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

use App\Post;
use App\Question;
use App\Option;

Route::get('/', function () {
    if(Auth::user()){
        return redirect('posts');
    }else{
        return view('auth.login');
    }
});
Route::get('/app', function () {
    return view('layouts.app');
});

Route::get('/contactus', function () {
    return view('posts.contactus');
});
Route::get('/dashboard', function () {
    return view('posts.dashboard');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users','UsersController');
Route::resource('posts','PostsController');
// Route::resource('comments','CommentController');
Auth::routes();

Route::post('comments/{post_id}', ['uses' => 'CommentController@store', 'as' => 'comments.store']);

Route::get('/home', 'HomeController@index')->name('home');

<<<<<<< HEAD
//Add Question Route
Route::get('/create/{post}/questions', 'QuestionsController@index');

Route::post('/posts/{post}/question', 'QuestionsController@store');

//Add options route
Route::get('/question/{id}', 'QuestionsController@indexOptions');

Route::post('/question/{question}/option', 'QuestionsController@storeOptions');

Route::patch('/options/{option}', 'QuestionsController@update');

Route::get('exam/{post}', 'ExamsController@index');
=======

Route::post('cps/{postid}',['uses'=>'CurrentPageController@store','as' => 'cps.store']);
Route::post('cps/{postid}',['uses'=>'CurrentPageController@update','as' => 'cps.update']);
>>>>>>> 9cb6b85eef06e033b4c02123c6fe1686d35e2bf6
