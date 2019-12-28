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


/*
Route::get('/about/{id}/{name}', function ($id, $name=) {
    //return view('welcome');
    return "su id es $id con nombre $name";
});

Route::get('/', function () {
    //return view('welcome');
    return "Hello world";
});
*/

Auth::routes();
Route::get('/', 'PagesController@index');
Route::get('/dashboard', 'dashboardController@index');
Route::post('/busqueda', 'PagesController@busqueda');
Route::post('/comentarios', 'PagesController@comentario');
Route::get('/ventas', 'PagesController@ventas');
Route::get('/administrar', 'PagesController@admin');
Route::get('/administrar/busquedaProd', 'PagesController@busquedaProd');
Route::get('/administrar/busquedaUser', 'PagesController@busquedaUser');
Route::get('/administrar/busquedaCat', 'PagesController@busquedaCat');
Route::get('/administrar/busquedaSub', 'PagesController@busquedaSub');
Route::get('/users', 'PagesController@destroy');
Route::post('/users/nuevo', 'PagesController@nuevo');
Route::post('/users', 'PagesController@edit');
Route::resource('categorias', 'CategoriasController');
Route::resource('subcategorias', 'SubcategoriasController');
Route::resource('productos', 'ProductosController');
Route::resource('carrito', 'CarritoController');




//Route::resource('posts', 'PostsController');





