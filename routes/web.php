<?php

Route::get('/admin', function () {
    return view('layouts.app');
});

// Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function () {

    Auth::routes();

    Route::middleware(['after' => 'auth'])->group(function () {

        Route::resource('produtos', 'Admin\ProductController', ['except' => [
            'show'
        ]]);
    });
});
