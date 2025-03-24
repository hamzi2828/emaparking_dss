<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/1/2019
 * Time: 10:02 AM
 */
use Illuminate\Support\Facades\Route;
Route::group(['prefix' => 'booking'],function (){
    Route::get('/import','BookingController@import')->name('report.admin.booking.import');
    Route::post('/import','BookingController@run_import')->name('report.admin.booking.run_import');
    Route::post('/','BookingController@store')->name('report.admin.booking.add');
    Route::get('/','BookingController@index')->name('report.admin.booking');
    Route::get('/cancellations','BookingController@cancellations')->name('report.admin.booking.cancel');
    Route::get('/amendments','BookingController@amendments')->name('report.admin.booking.amendments');

     Route::post('/api','BookingController@apiStoreBooking')->name('report.admin.booking.apiadd');

    Route::get('/priority','BookingController@priority')->name('report.admin.booking.priority');
    Route::post('/resend-confirmation/{id}','BookingController@resendConfirmation')->name('report.admin.booking.resend-confirmation');
    Route::get('/priority/completed','BookingController@priorityComplete')->name('report.admin.booking.priority.completed');
    Route::post('/priority/{id}','BookingController@priortize')->name('report.admin.booking.priotize');
    Route::post('/no-show/{id}','BookingController@noShow')->name('report.admin.booking.noShow');
    Route::post('/priority/re/{id}','BookingController@repriortize')->name('report.admin.booking.priotize.repriotize');
    Route::post('/priority/comp/{id}','BookingController@complete')->name('report.admin.booking.priotize.complete');
    Route::get('/drafts','BookingController@drafts')->name('report.admin.booking.drafts');
    Route::post('/print', 'BookingController@print')->name('report.admin.booking.print');
    Route::post('/export', 'BookingController@export')->name('report.admin.booking.export');
    Route::post('/update','BookingController@update')->name('report.admin.booking.update');
    Route::get('/email_preview/{id}','BookingController@email_preview')->name('report.admin.booking.email_preview');
    Route::post('/bulkEdit','BookingController@bulkEdit')->name('report.admin.booking.bulkEdit');
    Route::post('/check-in/{id}','BookingController@checkIn')->name('report.admin.booking.checkIn');
    Route::post('/check-out/{id}','BookingController@checkOut')->name('report.admin.booking.checkOut');
    Route::get('/parsing','BookingController@parsing')->name('report.admin.booking.parsing');
    Route::get('/parsing/retry/{id}','BookingController@retry_parsing')->name('report.admin.booking.parsing.retry');

});


Route::get('/enquiry','EnquiryController@index')->name('report.admin.enquiry.index');

Route::post('/enquiry/bulkEdit','EnquiryController@bulkEdit')->name('report.admin.enquiry.bulkEdit');

Route::get('/enquiry/{enquiry}/reply','EnquiryController@reply')->name('report.admin.enquiry.reply');
Route::post('/enquiry/{enquiry}/reply/store','EnquiryController@replyStore')->name('report.admin.enquiry.replyStore');


Route::get('/statistic','StatisticController@index')->name('report.admin.statistic.index');
Route::match(['get','post'],'/statistic/reloadChart','StatisticController@reloadChart')->name('report.admin.statistic.reloadChart');
