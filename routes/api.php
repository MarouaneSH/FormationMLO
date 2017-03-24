<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("getUsersDatatable","ApiController@getUsersDatatable");

Route::get("getUsers","ApiController@ShowUser");
Route::get("getSpecifiUsers","ApiController@getUser");
Route::get("getMessages","ApiController@ShowMessages");



//CRUD COURS
Route::get("AddBooks","ApiController@AddBooks");
Route::post("/AddBooks","ApiController@storeBooks")->name('StoreBooks');
Route::get("getAllCours","ApiController@getAllCours");
Route::get("RemoveCours","ApiController@RemoveCours");
Route::get("ModifyBooks","ApiController@ModifyBooks");
Route::post("editCours","ApiController@editCours")->name('editBooks');

//Add Cours Docs
Route::get('addCoursDocs',"ApiController@addCoursDocs");

//Genration de paiement
Route::get("genereteCode","ApiController@generateCode");


//New Message
Route::get('NewMessage',"ApiController@NewMessage");
Route::post('NewMessage',"ApiController@postMessage")->name('NewMessage');