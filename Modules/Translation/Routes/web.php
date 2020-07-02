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

Route::name('translation.')->prefix('translation')->group(function() {
    Route::get('/', 'TransGrpController@showAll')->name('allgroups');
    Route::get('/group/create', 'TransGrpController@create')->name('group.create');
    Route::post('/group/create', 'TransGrpController@createSave');
    Route::get('/group/edit/{id}', 'TransGrpController@edit');
    Route::post('/group/update', 'TransGrpController@saveEdit')->name('group.update');

    Route::get('/transbygroup/{name}', 'TransController@showAllbyGrp')->name('showAllbyGrp');
    Route::post('/transbygroup', 'TransController@showAllbyGrpSave')->name('showAllbyGrpSave');
    Route::get('/transbygroup/createkey/{grpname}', 'TransController@createTransKey')->name('createTransKey');
    Route::post('/transbygroup/createkey/{grpname}', 'TransController@createTransKeySave');
    Route::post('/transbygroup/deletekey/{grpname}', 'TransController@deleteTransKey')->name('transkey.delete');


    Route::get('/locales', 'TransLocaleController@showAll')->name('locales');
    Route::get('/locales/create', 'TransLocaleController@create')->name('locales.create');
    Route::post('/locales/create', 'TransLocaleController@createSave');
    Route::get('/locales/edit/{code}', 'TransLocaleController@edit');
    Route::post('/locales/update', 'TransLocaleController@editSave')->name('locales.update');;


    
    
});
