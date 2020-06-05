<?php

use Illuminate\Support\Facades\Artisan;

Auth::routes();

Route::middleware('auth')->group(function(){

	Route::get('/', LandingPageController::class);

	Route::middleware(['packageCheck', 'user'])->group(function(){

		Route::middleware(['active', 'payments.status'])->group(function(){

			Route::get('/log', 'UserController@log')->name('log');

			Route::get('/upload', 'UploadController@upload')->name('upload');

			Route::post('/create', 'UploadController@create')->name('create');

			Route::get('/upload/failed', 'UploadController@showFailedJob')->name('failed');

			Route::post('/upload/failed/action', 'UploadController@action')->name('failed.action');

		});

		Route::get('/home', 'HomeController@index')->name('home');

		Route::get('/profile', 'UserController@profile')->name('profile');

		Route::get('/packages', 'PackageController@index')->name('package.index');

		Route::get('/packages/list', 'PackageController@list')->name('package.list');

		Route::get('/payment', 'PaymentController@index')->name('payment');

		Route::get('/payment/status/{id}', 'PaymentController@status')->name('payment.status');
 
		Route::post('/payment/store', 'PaymentController@submitPayment')->name('payment.store');

		Route::get('/setting', 'UserSettingController@index')->name('setting.index');

		Route::post('/setting/store', 'UserSettingController@store')->name('setting.store');

		Route::get('/setting/cache/clear', 'UserSettingController@clearCache')->name('setting.clearCache');

		Route::get('/info', 'HomeController@info')->name('info');

		Route::get('/download', 'HomeController@getDownload')->name('download.format');
		
	});

	/*routes untuk admin*/
	Route::namespace('Admin')->prefix('admin')->middleware('admin')->group(function(){

		Route::get('/home', 'HomeAdminController@index')->name('admin.home');

		Route::get('/cache/clear', 'HomeAdminController@clear')->name('clear.cache');

		Route::resource('users', 'UserManagementController');

		Route::get('/status/{user}', 'UserManagementController@show')->name('user.payment.status');

		Route::resource('roles', 'RoleController');

		Route::resource('permissions', 'PermissionController');

	});

});

Route::get('clear-all', function(){
    Artisan::call('clear-compiled');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');

    return redirect()->route('home');
});

// No auth
Route::post('/notification/handler', 'PaymentController@notificationHandler')->name('notification.handler');


	




