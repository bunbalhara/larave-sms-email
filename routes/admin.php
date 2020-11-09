<?php

use Illuminate\Support\Facades\Route;


Route::post('/admin/message/status-callback','Admin\SmsController@statusCallback')->name('admin.message.status-callback');

Route::group(['as'=>'admin.', 'prefix'=>'admin', 'namespace'=>'Admin','middleware'=>['auth','role:admin']], function(){

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::group(['as'=>'user.', 'prefix'=>'user'], function(){
        Route::post('add', 'UsersController@add')->name('add');
        Route::post('delete', 'UsersController@delete')->name('delete');
        Route::post('edit', 'UsersController@edit')->name('edit');
        Route::post('update', 'UsersController@update')->name('update');
        Route::get('file-import-export', 'UsersController@fileImportExport');
        Route::post('file-import', 'UsersController@fileImport')->name('file-import');
        Route::get('file-export', 'UsersControllers@fileExport')->name('file-export');
        Route::get('/','UsersController@index')->name('index');
    });

    Route::group(['as'=>'sender.', 'prefix'=>'sender'], function(){
        Route::post('add','SenderController@add')->name('add');
        Route::post('delete','SenderController@delete')->name('delete');
        Route::post('edit','SenderController@edit')->name('edit');
        Route::post('update','SenderController@update')->name('update');
        Route::get('/','SenderController@index')->name('index');
    });

    Route::group(['as'=>'recipient.', 'prefix'=>'recipient'], function(){
        Route::post('add','RecipientController@add')->name('add');
        Route::post('delete','RecipientController@delete')->name('delete');
        Route::post('file-import', 'RecipientController@fileImport')->name('file-import');
        Route::get('/','RecipientController@index')->name('index');
    });


    Route::get('new-message', 'SmsController@newMessage')->name('new-message');
    Route::group(['as'=>'message.', 'prefix'=>'message'], function(){
        Route::post('send','SmsController@sendSms')->name('send');
        Route::post('delete','SmsController@delete')->name('delete');
        Route::get('/','SmsController@index')->name('index');
    });

    Route::group(['as'=>'setting.', 'prefix'=>'setting'], function(){
        Route::post('set','SettingController@set')->name('set');
        Route::get('get-phone-numbers','SettingController@getPhoneNumbers')->name('get-phone-numbers');

        Route::get('get-services','SettingController@getServices')->name('get-services');
        Route::post('service-name-add','SettingController@serviceNameAdd')->name('service-name-add');
        Route::post('service-name-edit','SettingController@serviceNameEdit')->name('service-name-edit');
        Route::post('service-name-update','SettingController@serviceNameUpdate')->name('service-name-update');
        Route::post('service-name-delete','SettingController@serviceNameDelete')->name('service-name-delete');
        Route::get('/','SettingController@index')->name('index');
    });
});

