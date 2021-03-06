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

Route::get('/','WelcomeController@index')->name('welcome');

 Route::get('blog/posts/{post}', [\App\Http\Controllers\Blog\PostController::class,'show'])->name('blog.show');

Route::get('blog/categories/{category}',[\App\Http\Controllers\Blog\PostController::class,'category'])->name('blog.category');
Route::get('blog/tags/{tag}',[\App\Http\Controllers\Blog\PostController::class,'tag'])->name('blog.tag');




Auth::routes();

Route::middleware(['auth'])->group(function (){

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('categories','CategoriesController');

Route::resource('posts','PostController');

Route::resource('tags','TagsController');

Route::get('trashed-post','PostController@trashed')->name('trashed-post.index');

Route::put('restore-post/{post}','PostController@restore')->name('restore-post');

});

Route::middleware(['auth','admin'])->group(function (){

   Route::get('users/profile','UsersController@edit')->name('users.edit-profile');
    Route:: get('users','UsersController@index')->name('users.index');
    Route::put('users/profile','UsersController@update')->name('users.update-profile');
    Route::post('users/{user}/make-admin','UsersController@makeAdmin')->name('users.make-admin');

});
