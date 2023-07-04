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

Route::post('sign-in', 'Auth\LoginController@loginA');
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
	Route::get('/','TicketsController@index');
	
	Route::get('/tickets/datatable', 'TicketsController@datatable');
	Route::post('tickets/changestatus', 'Admin\TicketsController@changestatus');
    Route::resource('/tickets', 'TicketsController');
	
	Route::get('/profile', 'ProfileController@index');
    Route::get('/profile/edit', 'ProfileController@edit');
    Route::patch('/profile/edit', 'ProfileController@update');
	
	Route::get('/profile/change-password', 'ProfileController@changePassword');
        Route::patch('/profile/change-password', 'ProfileController@updatePassword');
	
}); 


Route::group(['prefix' => 'admin','middleware' => ['auth', 'roles'],'roles' => 'AU'], function () {
	Route::get('/', 'Admin\AdminController@index');
	Route::get('/new-user-tickets', 'Admin\AdminController@newUserTicket');
	Route::get('/new-all-user-tickets', 'Admin\AdminController@newAllUserTicket');
	Route::get('/ticket-slug', 'Admin\AdminController@slugTicket');
	
	Route::post('tickets/document', 'Admin\TicketsController@document');
	Route::post('tickets/changestatus', 'Admin\TicketsController@changestatus');
	Route::post('tickets/assignuser', 'Admin\TicketsController@assignUser');
	Route::get('tickets/datatable', 'Admin\TicketsController@datatable');
    Route::resource('tickets', 'Admin\TicketsController');
	
	Route::get('roles/datatable', 'Admin\RolesController@datatable');
    Route::resource('/roles', 'Admin\RolesController');
	
	Route::get('/users/search', 'Admin\UsersController@search');
    Route::get('/users/datatable', 'Admin\UsersController@userDatatable');
    Route::resource('/users', 'Admin\UsersController');
	
	Route::resource('permissions', 'Admin\PermissionsController');
	
	
		Route::get('/profile', 'Admin\ProfileController@index')->name('profile.index');
        Route::get('/profile/edit', 'Admin\ProfileController@edit')->name('profile.edit');
        Route::patch('/profile/edit', 'Admin\ProfileController@update');
        //
        Route::get('/profile/change-password', 'Admin\ProfileController@changePassword')->name('profile.password');
        Route::patch('/profile/change-password', 'Admin\ProfileController@updatePassword');
	
	Route::resource('pages', 'Admin\PagesController');
	Route::resource('activitylogs', 'Admin\ActivityLogsController')->only(['index', 'show', 'destroy']);
	Route::resource('settings', 'Admin\SettingsController');
	Route::get('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
	Route::post('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);
});  

Route::fallback(function(){ 
  
 return response()->view('errors.404', [], 404);

 });



