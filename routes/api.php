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


Route::get("getUsers","ApiController@ShowUser");
Route::get("getSpecifiUsers","ApiController@getUser");
Route::get("getMessages","ApiController@ShowMessages");
Route::get("AddBooks","ApiController@AddBooks");
Route::post("/AddBooks","ApiController@storeBooks")->name('StoreBooks');


//CRUD COURS
Route::get("getAllCours","ApiController@getAllCours");
Route::get("RemoveCours","ApiController@RemoveCours");
Route::get("ModifyBooks","ApiController@ModifyBooks");
Route::post("editCours","ApiController@editCours")->name('editBooks');