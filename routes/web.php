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

//Dashboard View
Route::group(['middleware' => ['auth']], function () {

    Route::get('/formation',"DashboardController@index")->name('formation');
    Route::get('/Account',"DashboardController@account")->name('account');
    Route::get('/Subscription',"DashboardController@subscription")->name('subscription');


    //Change User ACCOUNT Information
    Route::post('/changeINFO','DashboardController@changeINFO')->name('changeINFO');

    //Send Request Paiement Validation
    Route::post('/Verification_demande',"subscription_controller@store")->name('verfication_demande');
});



Auth::routes();

Route::get('/home', 'HomeController@index');


// LOGOUT USERS
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout_user');

Route::get('/test',function(){
    return view('test');
});