<?php

use \Illuminate\Support\Facades\Route;


Route::get('/','SpaceController@index')->name('space.admin.index');
Route::get('/create','SpaceController@create')->name('space.admin.create');
Route::get('/edit/{id}','SpaceController@edit')->name('space.admin.edit');
Route::post('/store/{id}','SpaceController@store')->name('space.admin.store');
Route::post('/bulkEdit','SpaceController@bulkEdit')->name('space.admin.bulkEdit');
Route::get('/recovery','SpaceController@recovery')->name('space.admin.recovery');
Route::get('/getForSelect2','SpaceController@getForSelect2')->name('space.admin.getForSelect2');
Route::get('/getForSelect2','SpaceController@getForSelect2')->name('space.admin.getForSelect2');

Route::group(['prefix'=>'plan'],function (){
    Route::get('/','PlanController@index')->name('space.admin.plan.index');
    Route::post('/store/{id}','PlanController@store')->name('space.admin.plan.create');
    Route::get('edit/{id}','PlanController@edit')->name('space.admin.plan.edit');
});

Route::group(['prefix'=>'attribute'],function (){
    Route::get('/','AttributeController@index')->name('space.admin.attribute.index');
    Route::get('edit/{id}','AttributeController@edit')->name('space.admin.attribute.edit');
    Route::post('store/{id}','AttributeController@store')->name('space.admin.attribute.store');
    Route::post('/editAttrBulk','AttributeController@editAttrBulk')->name('space.admin.attribute.editAttrBulk');


    Route::get('terms/{id}','AttributeController@terms')->name('space.admin.attribute.term.index');
    Route::get('term_edit/{id}','AttributeController@term_edit')->name('space.admin.attribute.term.edit');
    Route::post('term_store','AttributeController@term_store')->name('space.admin.attribute.term.store');
    Route::post('/editTermBulk','AttributeController@editTermBulk')->name('space.admin.attribute.term.editTermBulk');

    Route::get('getForSelect2','AttributeController@getForSelect2')->name('space.admin.attribute.term.getForSelect2');
});

Route::group(['prefix'=>'availability'],function(){
    Route::get('/','AvailabilityController@index')->name('space.admin.availability.index');
    Route::get('/bookings','AvailabilityController@second')->name('space.admin.availability.second');
    Route::get('/loadDates','AvailabilityController@loadDates')->name('space.admin.availability.loadDates');
    Route::get('/loadDates-count','AvailabilityController@loadDates_count')->name('space.admin.availability.loadDates-count');
    Route::post('/store','AvailabilityController@store')->name('space.admin.availability.store');
});
