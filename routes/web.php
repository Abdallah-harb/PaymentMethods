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
Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'offers','namespace' => 'App\Http\Controllers\Offers'],function(){

    Route::get('/','OfferController@index')->name('offer.index');

    Route::get('offer/{details}','OfferController@show')->name('offer.show');
});

Route::get('get-checkout-id','App\Http\Controllers\PaymentProviderController@getcheckoutid')->name('offer.checkout');
