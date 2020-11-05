<?php

use Illuminate\Support\Facades\Route;

Route::group(['as'=>'user.', 'prefix'=>'account', 'namespace'=>'User','middleware'=>['auth','verified']], function(){
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});