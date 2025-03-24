<?php

use \Illuminate\Support\Facades\Route;

Route::get('/','DashboardController@index')->name('admin.index');

Route::get('/get_contacts','DashboardController@getContacts')->name('admin.getContacts');
