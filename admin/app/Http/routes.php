<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// Route::get('/phpinfo', function(){
//     phpinfo();
// });

// resource
// Route::get('b2c/users/status/{id}/{status}','b2c\users\userController@getStatus');
// Route::resource('b2c/users','b2c\users\userController');

// Route::get('/', function () {
//     return view('welcome');
// });

//Route::get('/dashboard',array('as' => '', 'uses' => 'dashboard\dashboard@index'));

Route::group([['prefix' =>'dashboard','middleware' => 'auth']],function(){
	Route::get('/dashboard','dashboard\dashboard@index');
	Route::resource('dashboard/my_profile','dashboard\dashboard@my_profile');
	Route::resource('dashboard/profile_update','dashboard\dashboard@profile_update');
	Route::resource('dashboard/change_password','dashboard\dashboard@change_password');
	Route::resource('dashboard/password_update','dashboard\dashboard@password_update');
});

Route::group([['prefix' =>'notification','middleware' => 'auth']],function(){
	Route::get('notification/lists','notification@notificationLists');
	Route::get('notification/count','notification@getSupplierNoticeCount');
});

//B2C USERS
Route::group(['prefix' =>'b2c','namespace'=>'b2c', 'middleware' => 'auth'], function() {
	Route::group(['prefix' =>'','namespace'=>'users'], function() {
		Route::get('users/status/{id}/{status}','userController@getStatus');
		Route::get('users/setStatus/{id}/{status}/{table}','userController@setStatus');
		Route::resource('users/email_subscribers','userController@email_subscribers');
		Route::resource('users','userController');
	});
	Route::group(['prefix' =>'hotels','namespace'=>'hotels', 'middleware' => 'auth'], function() {
		Route::resource('markup','markupController');
		Route::get('apiinfo/status/{id}/{status}','apiinfoController@status');
		Route::resource('apiinfo','apiinfoController');
		Route::resource('reports/voucher','reportsController@booking_reports');
		Route::get('reports/cancellation/{param1}/{param2}','reportsController@booking_cancel');
		Route::resource('reports','reportsController');
	});
	Route::group(['prefix' =>'villas','namespace'=>'villas', 'middleware' => 'auth'], function() {
		// Route::resource('markup','markupController');
		Route::resource('reports/voucher','reportsController@booking_reports');
		Route::get('reports/cancellation/{param1}/{param2}','reportsController@booking_cancel');
		Route::resource('reports','reportsController');
	});
	Route::group(['prefix' =>'holidays','namespace'=>'holidays', 'middleware' => 'auth'], function() {
		Route::resource('markup','markupController');
		Route::get('apiinfo/status/{id}/{status}','apiinfoController@status');
		Route::resource('apiinfo','apiinfoController');
		Route::resource('reports/voucher','reportsController@booking_reports');
		Route::resource('reports','reportsController');
	});
});

//B2B USERS
Route::group(['prefix' =>'b2b','namespace'=>'b2b','middleware' => 'auth'], function() {
	Route::group(['prefix' =>'','namespace'=>'users'], function() {
		Route::get('users/status/{id}/{status}','userController@getStatus');
		Route::resource('users','userController');
	});
	Route::group(['prefix' =>'hotels','namespace'=>'hotels', 'middleware' => 'auth'], function() {
		Route::resource('markup','markupController');
		Route::get('apiinfo/status/{id}/{status}','apiinfoController@status');
		Route::resource('apiinfo','apiinfoController');
		Route::resource('reports/voucher','reportsController@booking_reports');
		Route::get('reports/cancellation/{param1}/{param2}','reportsController@booking_cancel');
		Route::resource('reports','reportsController');
	});
	Route::group(['prefix' =>'villas','namespace'=>'villas', 'middleware' => 'auth'], function() {
		// Route::resource('markup','markupController');
		Route::resource('reports/voucher','reportsController@booking_reports');
		Route::get('reports/cancellation/{param1}/{param2}','reportsController@booking_cancel');
		Route::resource('reports','reportsController');
	});
	Route::group(['prefix' =>'holidays','namespace'=>'holidays', 'middleware' => 'auth'], function() {
		Route::resource('markup','markupController');
		Route::get('apiinfo/status/{id}/{status}','apiinfoController@status');
		Route::resource('apiinfo','apiinfoController');
		Route::resource('reports/voucher','reportsController@booking_reports');
		Route::resource('reports','reportsController');
	});
});

//Tours
Route::group(['prefix' =>'tours','namespace'=>'tours', 'middleware' => 'auth'], function() {
	Route::group(['prefix' =>'','namespace'=>'regions'], function() {
		Route::resource('regions/country','regionController@country');
		Route::resource('regions/updateCountry','regionController@updateCountry');
		Route::resource('regions/state','regionController@state');
		Route::resource('regions/updateState','regionController@updateState');
		Route::get('regions/status/{city_id}/{status}','regionController@getStatus');
		Route::resource('regions/city','regionController@city');
		Route::resource('regions/updateCity','regionController@updateCity');
	});
	Route::group(['prefix' =>'','namespace'=>'holidays'], function() {
		Route::get('holidays/status/{theme_id}/{status}','holidayController@getThemeStatus');
		// Route::get('holidays/hstatus/{holiday_id}/{status}','holidayController@getHolidayStatus');
		Route::resource('holidays/theme','holidayController@theme');
		Route::resource('holidays/updateTheme','holidayController@updateTheme');
		// Route::resource('holidays/itinerary','holidayController@itinerary');
		// Route::resource('holidays/addHoliday','holidayController@addHoliday');
		// Route::resource('holidays/list','holidayController@holidayList');
		// Route::resource('holidays/delete_image','holidayController@delete_image');
		// Route::get('holidays/activities/{holiday_id}','holidayController@activities');
		// Route::resource('holidays/addActivity','holidayController@addActivity');
		// Route::get('holidays/meeting_points/{holiday_id}','holidayController@meeting_points');
		// Route::resource('holidays/addMeetingPoints','holidayController@addMeetingPoints');
	});
});

//Suppliers
Route::group(['prefix' =>'suppliers','namespace'=>'suppliers', 'middleware' => 'auth'], function() {
	Route::group(['prefix' =>'','namespace'=>'users', 'middleware' => 'auth'], function() {
		Route::get('users/status/{id}/{status}','supplierController@getStatus');
		Route::get('users/change_password/{id}','supplierController@change_password');
		Route::resource('users/password_update','supplierController@password_update');
		Route::get('users/emailtest', 'supplierController@emailtest');
		Route::get('users/emailtest2', 'supplierController@emailtest2');
		Route::resource('users','supplierController');
	});

	Route::get('hotels/preview/{id}','hotelController@preview');
	Route::get('hotels/status/{id}/{supplier_id}/{status}','hotelController@changestatus');
	Route::get('hotels/{id?}','hotelController@hotellist');
	Route::get('hotels/refresh_hotels/{id}','hotelController@refresh_hotels');

	Route::get('tours/preview_holiday/{id}','tourController@preview');
	Route::get('tours/status/{id}/{supplier_id}/{status}','tourController@changestatus');
	Route::get('tours/{id?}','tourController@tour_list');

	Route::get('villas/preview/{id}','villaController@preview');
	Route::get('villas/status/{id}/{supplier_id}/{status}','villaController@changestatus');
	Route::get('villas/{id?}','villaController@villa_list');
});

//CONTROL MANAGEMENT
Route::group(['prefix' =>'controls','namespace'=>'controls','middleware' => 'auth'], function() {
	Route::get('apiinfo/status/{id}/{status}','apiManageController@status');
	Route::resource('apiinfo','apiManageController');
	Route::resource('currencyinfo/updateCurrency','currencyController@currencyUpdate');
	Route::get('currencyinfo/status/{id}/{status}','currencyController@status');
	Route::resource('currencyinfo','currencyController');
	Route::get('promoManager/status/{id}/{status}','promoController@status');
	Route::resource('promoManager','promoController');

	Route::resource('popularcities','controlsController');
	Route::resource('addPopularcities','controlsController@add');
	Route::get('status/{id}/{status}','controlsController@getStatus');
	Route::get('citylist','controlsController@getCityList');
	Route::get('cityListTour','controlsController@getCityListTour');

	Route::resource('banners','controlsController@banners');
	Route::resource('addBanner','controlsController@addBanner');

	Route::resource('popularDestination','controlsController@popularDestination');
	Route::resource('addPopularDestination','controlsController@addPopularDestination');
	Route::resource('topDeals','controlsController@topDeals');
	Route::resource('addDeals','controlsController@addDeals');

	Route::resource('subscription','controlsController@subscription');
	Route::resource('addSubs','controlsController@addSubs');

	Route::resource('addDiscounts','controlsController@addDiscounts');

	Route::get('setStatus/{id}/{status}/{table}','controlsController@setStatus');
	Route::get('deleteStatus/{id}/{table}','controlsController@deleteStatus');
});

//CMS
Route::group(['prefix' =>'cms','namespace'=>'cms','middleware' => 'auth'],function(){
	Route::resource('content','contentController');
	Route::resource('hotelcitylist','hotelcitylistController');
	Route::resource('topdeals','topdealsController');
	Route::get('topdeals/status/{id}/{status}','topdealsController@getStatus');
	Route::resource('topdealshotel','topdealshotelController');
	Route::get('topdealshotel/add/{id}','topdealshotelController@add');
	Route::get('topdealshotel/status/{id}/{status}','topdealshotelController@getStatus');
	Route::resource('aboutcity','aboutcityController');
	Route::get('aboutcity/status/{id}/{status}','aboutcityController@getStatus');
	Route::resource('popularhotel','popularhotelController');
	Route::get('popularhotel/status/{id}/{status}','popularhotelController@getStatus');
	Route::resource('popularcityhotel','popularcityhotelController');
	Route::get('popularcityhotel/status/{id}/{status}','popularcityhotelController@getStatus');
	Route::get('popularhotel/add/{id}','popularhotelController@add');
});

Route::get('aboutcity/citylist','cms\aboutcityController@getCityList');
Route::get('popularcityhotel/citylist','cms\popularcityhotelController@getCityList');
Route::get('popularhotel/hotellist/{id}','cms\popularhotelController@getHotelList');
Route::get('topdealshotel/hotellist/{id}','cms\topdealshotelController@getHotelList');
// Authentication routes...
Route::get('/', 'Adminlogin@index');
// Route::get('/login', 'Adminlogin@index');
Route::post('/login', 'Adminlogin@authenticate');
Route::get('/logout', 'Adminlogin@logout');


//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

