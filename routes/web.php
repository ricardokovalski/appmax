<?php

Route::get('/', function () {
    return \Redirect::to('admin/login');
});

//Route::get('/admin', function () {
//    return view('layouts.app');
//});

// Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('admin')->group(function () {

    Auth::routes();

    Route::middleware(['after' => 'auth'])->group(function () {

        Route::resource('produtos', 'Admin\ProductController', ['except' => [
            'show'
        ]]);
        Route::get('produtos/decrement/{id}', ['as' => 'produtos.decrement', 'uses' => 'Admin\ProductController@decrement']);

        Route::get('relatorios', ['as' => 'relatorios', 'uses' => 'Admin\ReportController@index']);
    });
});




