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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/post', 'PostController@index');
Route::get('/post/create', 'PostController@create');
Route::post('/post/save', 'PostController@save');
Route::post('/post/delete/{id}', 'PostController@delete');
Route::get('/post/edit/{id}', 'PostController@edit');
Route::post('/post/update', 'PostController@update');
Route::get('/post/show/{id}', 'PostController@show');
Route::get('/post/popular', 'PostController@popular');
Route::get('/post/tags', 'PostController@tags');
Route::get('/post/tag/{tagid}', 'PostController@tagposts'); // 取得某个标签下的所有博客

Route::get('/image', 'ImageController@index');
Route::post('/image/upload', 'ImageController@upload');
Route::get('/image/create', 'ImageController@create');
Route::post('/image/save', 'ImageController@save');
Route::post('/image/delete/{id}', 'ImageController@delete');
Route::get('/image/edit/{image}', 'ImageController@edit');
Route::post('/image/update', 'ImageController@update');
Route::get('/image/show/{id}', 'ImageController@show');

Route::get('/tag', 'TagController@index');
Route::get('/tag/create', 'TagController@create');
Route::post('/tag/save', 'TagController@save');
Route::post('/tag/delete', 'TagController@delete');
Route::post('/tag/restore', 'TagController@restore');
Route::get('/tag/edit/{tag}', 'TagController@edit');
Route::post('/tag/update', 'TagController@update');
Route::get('/tag/show/{id}', 'TagController@show');
Route::get('/tag/top10', 'TagController@index@top10');

Route::get('/t', 'TestController@index');
Route::get('/t/oneToOne', 'TestController@oneToOne');
Route::get('/t/oneToOneInverse', 'TestController@oneToOneInverse');
Route::get('/t/oneToMany', 'TestController@oneToMany');
Route::get('/t/oneToManyInverse', 'TestController@oneToManyInverse');
Route::get('/t/oneToMany2', 'TestController@oneToMany2');
Route::get('/t/oneToManyInverse2', 'TestController@oneToManyInverse2');
Route::get('/t/manyToMany', 'TestController@manyToMany');
Route::get('/t/manyToManyInverse', 'TestController@manyToManyInverse');
Route::get('/t/retrievingIntermediate', 'TestController@retrievingIntermediate');
Route::get('/t/hasManyThrough', 'TestController@hasManyThrough');
Route::get('/t/polymorphicRelations', 'TestController@polymorphicRelations');
Route::get('/t/polymorphicRelationsInverse', 'TestController@polymorphicRelationsInverse');
Route::get('/t/manyToManyPolymorphicRelations', 'TestController@manyToManyPolymorphicRelations');
Route::get('/t/manyToManyPolymorphicRelationsInverse', 'TestController@manyToManyPolymorphicRelationsInverse');

Route::get('/tc', 'TestCollectionsController@index');
Route::get('/tc/all', 'TestCollectionsController@all');
Route::get('/tc/avg', 'TestCollectionsController@avg');
Route::get('/tc/chunk', 'TestCollectionsController@chunk');
Route::get('/tc/collapse', 'TestCollectionsController@collapse');
Route::get('/tc/combine', 'TestCollectionsController@combine');
Route::get('/tc/contains', 'TestCollectionsController@contains');
Route::get('/tc/count', 'TestCollectionsController@count');
Route::get('/tc/diff', 'TestCollectionsController@diff');
