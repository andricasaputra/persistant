<?php

Auth::routes();

Route::middleware('auth')->group(function(){

	Route::get('/', LandingPageController::class);

	Route::middleware(['packageCheck', 'user'])->group(function(){

		Route::middleware('active')->group(function(){

			Route::get('/log', 'UserController@log')->name('log');

			Route::get('/upload', 'UploadController@upload')->name('upload');

			Route::post('/create', 'UploadController@create')->name('create');

		});

		Route::get('/home', 'HomeController@index')->name('home');

		Route::get('/profile', 'UserController@profile')->name('profile');

		Route::get('/packages', 'PackageController@index')->name('package.index');

		Route::get('/packages/list', 'PackageController@list')->name('package.list');

		Route::get('/payment', 'PaymentController@index')->name('payment');

		Route::post('/payment/finish', function(){
		    return redirect()->route('payment');
		})->name('payment.finish');
 
		Route::post('/payment/store', 'PaymentController@submitPayment')->name('payment.store');

		Route::post('/notification/handler', 'PaymentController@notificationHandler')->name('notification.handler');
	});

	/*routes untuk admin*/
	Route::namespace('Admin')->prefix('admin')->middleware('admin')->group(function(){

		Route::get('/home', 'HomeAdminController@index')->name('admin.home');

		Route::get('/clear_cache', 'ResponseCacheController@clear')->name('clear.cache');

		Route::resource('users', 'UserManagementController');

		Route::resource('roles', 'RoleController');

		Route::resource('permissions', 'PermissionController');

	});

});


	




