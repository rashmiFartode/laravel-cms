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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/blog/post/{post}', 'Blog\PostsController@show')->name('post.show');
Route::get('/blog/categories/{category}', 'Blog\PostsController@category')->name('blog.category');
Route::get('/blog/tags/{tag}', 'Blog\PostsController@tag')->name('blog.tag');

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::resource('categories', 'CategoryController');
    Route::resource('tags', 'TagsController');
    Route::resource('posts', 'PostController');
    // Route::resource('tags', 'TagsController');
    // Route::resource('posts', 'PostController');
    Route::get('trashed-posts', 'PostController@trashed')->name('trashed-posts.index');
    Route::put('restore-posts/{id}', 'PostController@restore')->name('restore-posts');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('users', 'UserController@index')->name('users.index');
    Route::post('users/{users}/make-admin', 'UserController@makeAdmin')->name('users.make-admin');
});
