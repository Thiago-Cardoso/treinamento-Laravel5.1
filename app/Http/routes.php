<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('home', 'HomeController@index');

Route::controllers([
'auth' => 'Auth\AuthController',
'password' => 'Auth\PasswordController',
]);

Route::get('/login', 'LoginController@login');

Route::get('/', function () {
    return '<h1>Primeira logica com o laravel</h1>';
});

/*
Route::get('/', function()
{
	//return '<h1>Outra lógica com Laravel</h1>';
});
*/

Route::get('/', 'ProdutoController@lista');

//crio um novo router controller
Route::get('/produtos', 'ProdutoController@lista');

//mostra
//Route::get('/produtos/mostra', 'ProdutoController@mostra');

//Route::get('/produtos/mostra/{id}', 'ProdutoController@mostra');


Route::get('/produtos/mostra/{id}',
'ProdutoController@mostra')
->where('id', '[0-9]+');


Route::get('/produtos/novo', 'ProdutoController@novo');

Route::post('/produtos/adiciona', 'ProdutoController@adiciona');

Route::get('/produtos/json', 'ProdutoController@listaJson');

//Route::get('/produtos/remove/{id}', 'ProdutoController@remove');

Route::get('/produtos/remove/{id}', [
	'middleware' => 'nosso-middleware',
	'uses' => 'ProdutoController@remove'
]);

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function() {
    // Place all your web routes here...(Cut all `Route` which are define in `Route file`, paste here) 
});


