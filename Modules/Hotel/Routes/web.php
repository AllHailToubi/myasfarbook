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

Route::name('hotel.')->prefix('hotel')->group(function() {
    Route::get('/test', 'TestController@test');
    

    Route::get('/allHotels', 'hotelController@allHotels')->name('allHotels');
    Route::post('/newhotel', 'hotelController@newHotel')->name('newHotel');
    Route::get('/allArchiveHotels', 'hotelController@allArchiveHotels')->name('allArchiveHotels');
    Route::post('/delete', 'hotelController@delete')->name('delete');
    Route::get('/edit/{id}', 'hotelController@edit')->name('edit');
    Route::post('/saveupdate', 'hotelController@saveupdate')->name('saveupdate');
    Route::post('/uploadImage', 'hotelController@uploadImage')->name('uploadImage');
    Route::post('/addToGallery', 'hotelController@addToGallery')->name('addToGallery');
    Route::post('/deleteimage', 'hotelController@deleteimage')->name('deleteimage');
    Route::post('/deleteimageGallery', 'hotelController@deleteimageGallery')->name('deleteimageGallery');

    Route::get('/{id}/allRooms', 'RoomController@allRooms')->name('allRooms');
    Route::post('/newRoom', 'RoomController@newRoom')->name('newRoom');
    Route::get('/editroom/{id}', 'RoomController@editRoom')->name('editRoom');
    Route::post('/editroom/{id}', 'RoomController@saveupdate');
    Route::post('/deleteroom', 'RoomController@delete')->name('deleteroom');
    Route::get('/{id}/availabilityRooms', 'RoomController@availabilityRooms')->name('availabilityRooms');
    Route::post('/{id}/avibilityMonth', 'RoomController@avibilityMonth')->name('avibilityMonth');
    Route::post('/{id}/avibilitySetPrice', 'RoomController@avibilitySetPrice')->name('avibilitySetPrice');

   
    
    Route::post('/room/uploadImage', 'RoomController@uploadImage')->name('uploadImage_room');
    Route::post('/room/addToGallery', 'RoomController@addToGallery')->name('addToGallery_room');
    Route::post('/room/deleteimage', 'RoomController@deleteimage')->name('deleteimage_room');
    Route::post('/room/deleteimageGallery', 'RoomController@deleteimageGallery')->name('deleteimageGallery_room');
    
});

Route::name('facilities.')->prefix('facilities')->group(function() {
    Route::get('/facilities', 'FacilitiesController@listHotelFacilities')->name('hotel');
    Route::post('/facilities', 'FacilitiesController@listHotelFacilitiesSave');
});  





