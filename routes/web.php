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
    Route::get('/cron-run',function(){
       $c= \Artisan::call('cron:send_news_letter');
       $out=\Artisan::output();
       dd($c, $out);
    });
Route::get('/intro','LandingpageController@index');
Route::get('/', 'HomeController@index')->name('index');
Route::get('/about-us', 'HomeController@about')->name('about');
// Route::get('/Terms-and-Conditions', 'HomeController@termsAndConditions')->name('termsAndConditions');

Route::get('/frequently-asked-questions', 'HomeController@faq')->name('faq');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/install/check-db', 'HomeController@checkConnectDatabase');

// Social Login
Route::get('social-login/{provider}', 'Auth\LoginController@socialLogin');
Route::get('social-callback/{provider}', 'Auth\LoginController@socialCallBack');

// Logs
Route::get(config('admin.admin_route_prefix').'/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware(['auth', 'dashboard','system_log_view'])->name('admin.logs');

Route::get('/install','InstallerController@redirectToRequirement')->name('LaravelInstaller::welcome');
Route::get('/install/environment','InstallerController@redirectToWizard')->name('LaravelInstaller::environment');

Route::post('/subscribe','HomeController@subscribe')->name('subscribe');

// Route::get('page/terms-conditions', 'HomeController@termsAndConditions')->name('page/terms-conditions'); 



