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

Route::name('web.')->prefix('web')->group(function() {
    Route::get('/hotels/list', 'HotelsWebController@listhotels')->name('hotels.list');

    Route::get('/{id}/slideshow', 'HotelsWebController@slideshow')->name('slideshow');

    Route::get('/hotels/list/{type}', 'HotelsWebController@listHotelsType')->name('hotels.list.type');

    Route::get('/hotel/detail', 'HotelsWebController@showHoteldetail')->name('hotels.showHoteldetail');
    
});
