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





Route::group(['prefix' => 'users'], function() {

    Route::get('', "HyperWalletController@listUsers");

    Route::post('', 'HyperWalletController@createUser');
});


Route::group(['prefix' => 'bank_account'], function() {

    Route::get('/{token}', "HyperWalletController@listPayments");

    Route::post('', 'HyperWalletController@createBanckAccount');
});

Route::group(['prefix' => 'payment'], function() {

    Route::post('', 'HyperWalletController@createPayment');

});