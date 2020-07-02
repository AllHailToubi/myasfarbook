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


Route::prefix('user')->group(function() {
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

    Route::get('/', 'UserController@allusers')->name('user.allusers');
    Route::get('/newuser', 'UserController@newuser')->name('user.newuser');
    Route::post('/newuser', 'UserController@newuserstore');
    Route::post('/delete', 'UserController@delete')->name('user.delete');
    Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
    Route::post('/edit/save', 'UserController@editsave')->name('user.editsave');
    Route::get('/changemypassword', 'UserController@changeMyPassword')->name('user.changemypassword');
    Route::post('/changemypassword', 'UserController@changeMyPasswordUpdate');

    Route::get('/editprofile', 'UserController@editprofile')->name('user.editprofile');
    Route::post('/editprofile', 'UserController@updateprofile');

    
    Route::get('/roles', 'UserRolesController@allroles')->name('user.allroles');
    Route::get('/roles/create', 'UserRolesController@create')->name('user.roles.create');
    Route::post('/roles/create', 'UserRolesController@createstore');
    Route::get('/roles/edit/{id}', 'UserRolesController@edit');
    Route::post('/roles/edit/save', 'UserRolesController@editupdate')->name('user.roles.update');
    Route::post('/roles/delete', 'UserRolesController@delete')->name('user.roles.delete');
    
    Route::get('/roles/permissionsmatrix', 'PermissionsController@showPermissionsMatrix')->name('user.showpermissionsmatrix');
    Route::post('/roles/permissionsmatrix', 'PermissionsController@updatePermissionMatrix');

    
    Route::get('/permissions', 'PermissionsController@AllPermissions')->name('user.AllPermissions');
    Route::post('/permissions', 'PermissionsController@updatePermissions')->name('user.Permissions');
    Route::get('/permissions/create', 'PermissionsController@createPermission')->name('user.permissions.create');
    Route::post('/permissions/create', 'PermissionsController@createPermissionStore');
    Route::get('/permissions/edit/{id}', 'PermissionsController@editPermission');
    Route::post('/roles/update', 'PermissionsController@editPermissionupdate')->name('user.permissions.update');

    Route::get('/locale/{locale}', 'UserController@changeLocale')->name('user.changeLocale');
    
    
});


