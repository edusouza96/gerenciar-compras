<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('listas.montar');
});

Route::group(['prefix' => 'lista'], function () {
    Route::get('montar', ['as' => 'listas.montar', 'uses' => 'ListaController@montar']);
    Route::post('salvar', ['as' => 'listas.salvar', 'uses' => 'ListaController@salvar']);
    Route::get('visualizar/{mesAno}', ['as' => 'listas.visualizar', 'uses' => 'ListaController@visualizar']);
    Route::get('lista/json/{mesAno}', ['as' => 'listas.lista.json', 'uses' => 'ListaController@listaJson']);
    Route::get('lista-disponivel/json', ['as' => 'listas.listas-disponiveis.json', 'uses' => 'ListaController@listasDisponiveisJson']);
});

Route::group(['prefix' => 'produtos'], function () {
    Route::get('lista/json', ['as' => 'produtos.lista.json', 'uses' => 'ProdutoController@listaJson']);
    Route::post('salvar/json', ['as' => 'produtos.salvar.json', 'uses' => 'ProdutoController@salvarJson']);
});
