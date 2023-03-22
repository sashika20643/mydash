<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// user module route
Route::post('/user/store','userController@signup');
Route::get('/user-profile-details','userController@profile_details');
Route::post('/user/profile/update','userController@profile_update');
Route::get('/user/profile/destroy','userController@destroy');
Route::post('/user/profile/save-user','userController@save_user');
Route::get('/user/is_block','userController@is_block');
Route::get('/user/push_notification/{id}','userController@push_notification');

// country module route

Route::get('/country/view','country_controller@view');
Route::post('/country/store','country_controller@store');
Route::post('/country/update','country_controller@update');
Route::get('/country/destroy','country_controller@destroy');
Route::get('/country/destroyAll','country_controller@destroyAll');

// category module route

Route::get('/gifts/category/view','giftsController@cat_view');
Route::post('/gifts/category/store','giftsController@store');
Route::post('/gifts/category/update','giftsController@update');
Route::get('/gifts/category/destroy','giftsController@destroy');
Route::get('/gifts/category/destroyAll','giftsController@destroyAll');
Route::get('/gifts/category/isTopToggle','giftsController@isTopToggle');


// gifts module routes

Route::post('/gifts/gift/store','giftsController@gift_store');
Route::get('/gifts/gift/view','giftsController@view');
Route::get('/get-gifts-details','giftsController@gift_details');
Route::post('/gifts/gift/update','giftsController@gift_update');
Route::get('/gifts/gift/destroy','giftsController@gift_destroy');
Route::get('/gifts/gift/destroyAll','giftsController@gift_destroyAll');

// Emoji modules routes

Route::get('/effect/emoji/view','emojiController@emoji_view');
Route::post('/effect/emoji/store','emojiController@store');
Route::get('/get-effect-emoji-details','emojiController@details');
Route::post('/effect/emoji/update','emojiController@update');
Route::get('/effect/emoji/destroy','emojiController@destroy');
Route::get('/effect/emoji/destroyAll','emojiController@destroyAll');


// Advertisment route modules
Route::get('/advertisment/view/lists','advertismentController@lists');
Route::get('/get-advertisment-details','advertismentController@details');
Route::post('/advertisment/update','advertismentController@update');
Route::get('/advertisment/is_active','advertismentController@is_active');


// setting route module
Route::post('/setting/store','settingController@store');

// live user host
Route::get('/liveuser/enable-host','livehostController@enable_host');

// point management module

Route::post('/point/store','pointMangementController@store');

// sticker module

Route::get('/effect/sticker/view','stickerController@view');
Route::post('/effect/sticker/store','stickerController@store');
Route::post('/effect/sticker/update','stickerController@update');
Route::get('/effect/sticker/destroy','stickerController@destroy');
Route::get('/get-effect-sticker-details','stickerController@details');
Route::get('/effect/sticker/destroyAll','stickerController@destroyAll');


// chat module
Route::post('/chat/store','chatController@store');
Route::get('/chat/get-old-Chat','chatController@get_old_Chat');
