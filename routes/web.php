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

//Route::get('/tasks', 'TasksController@index');
//Route::get('/tasks/{task}', 'TasksController@show');



$stripe = App::make('App\Billing\Stripe');
// or the another variants:
//$stripe = resolve('App\Billing\Stripe');
//$stripe = app('App\Billing\Stripe');

dd($stripe);



Route::get('/', 'PostsController@index')->name('home');
Route::get('/posts/create', 'PostsController@create');
Route::post('/posts', 'PostsController@store');
Route::get('/posts/{post}', 'PostsController@show');

Route::post('/posts/{post}/comments', 'CommentsController@store');

Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');

// controller - PostsController     =>  php artisan make:controller PostsController
// Eloquent model - Post            =>  php artisan make:model Post
// migration - create_posts_table   =>  php artisan make:migration create_posts_table --create=posts

// ***or in 1 command***
// php artisan make:model Post -mc



//GET /posts
//GET /posts/create
//POST /posts
//GET /posts/{id}/edit
//GET /posts/{id}
//PATCH /posts/{id}
//DELETE /posts/{id}












