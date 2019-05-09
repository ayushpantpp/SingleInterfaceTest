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
    return view('welcome');
});

Route::get('/products', 
['uses'=>'ProductsController@index',
            'as' => 'product.index'
            ]);
Route::get('/add-to-cart/{id}', 
            ['uses'=>'ProductsController@addToCart',
            'as' => 'product.addToCart'
            ]);

Route::get('/view-cart', 
            ['uses'=>'ProductsController@shoppingCart',
            'as' => 'product.shoppingCart'
            ]);
