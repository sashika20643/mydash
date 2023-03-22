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

Route::get('/', function () {
    return view('login');
});

Route::get('/signups', function () {
    return view('signup');
});
Route::get('/test', 'FirebaseController@push')->name('test');

Route::get('/signup', 'userController@signup')->name('signup');
Route::get('/country', 'country_controller@index')->name('country');
Route::post('/add-country', 'country_controller@add_country')->name('add-country');
Route::get('/user', 'userController@index')->name('user');
Route::get('/get-country-details', 'country_controller@get_country_details')->name('get-country-details');
Route::get('/category', 'giftsController@index')->name('category');
Route::get('/gift', 'giftsController@gifts')->name('gift');
Route::get('/all-users', 'userController@all_users')->name('all-users');
Route::get('/add-users', 'userController@add_users')->name('add-users');
Route::get('/settings', 'settingController@index')->name('settings');
Route::get('/live-user', 'livehostController@index')->name('live-user');
Route::get('/point-management', 'pointMangementController@index')->name('point-management');
Route::get('/filter-point', 'pointMangementController@filter_point')->name('filter-point');
Route::get('/payment-redeem-request/{id?}', 'paymentRedeemController@index');
Route::get('/advertisment', 'advertismentController@index')->name('advertisment');
Route::get('/add-payment-redeem', 'paymentRedeemController@add_payment_redeem')->name('add-payment-redeem');
Route::get('/point-information', 'pointInformationController@index')->name('point-information');
Route::get('/emoji', 'emojiController@index')->name('emoji');
Route::get('/get-gifts-category-details', 'giftsController@category_details')->name('get-gifts-category-details');
Route::get('/sticker', 'stickerController@index')->name('sticker');
Route::get('/filter-point-management', 'pointInformationController@filter_point_management')->name('filter-point-management');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
