<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('uploadFile', 'FileUploadController@uploadFile');

Route::group(['prefix' => 'user'], function () {

    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@login');
    Route::post('updateProfilePicture', 'UserController@updateProfilePicture');
    Route::post('updateFcmKey', 'UserController@updateFcmKey');
    Route::post('update', 'UserController@update');
    Route::post('searchUsers', 'UserController@searchUsers');
    Route::post('userProfile', 'UserController@userProfile');
    Route::post('updateProfile', 'UserController@updateProfile');
    Route::post('sendMail', 'MailController@sendMail');
});
Route::group(['prefix' => 'ad'], function () {

    Route::post('storeAd', 'AdsController@storeAd');
    Route::post('listOfAds', 'AdsController@listOfAds');
    Route::post('viewAd', 'AdsController@viewAd');
    Route::post('getAdsInCategory', 'AdsController@getAdsInCategory');
    Route::post('getUserAds', 'AdsController@getUserAds');
    Route::post('getMyAds', 'AdsController@getMyAds');
    Route::post('browseAds', 'AdsController@browseAds');
    Route::post('getMyPendingAds', 'AdsController@getMyPendingAds');
    Route::post('changeAdStatus', 'AdsController@changeAdStatus');
    Route::post('searchResults', 'AdsController@searchResults');
    Route::post('filterResults', 'AdsController@filterResults');
    Route::post('getFavoriteListOfAds', 'AdsController@getFavoriteListOfAds');

});
Route::group(['prefix' => 'like'], function () {

    Route::post('likeAd', 'LikesController@likeAd');
    Route::post('unlikeAd', 'LikesController@unlikeAd');


});
Route::group(['prefix' => 'admin'], function () {

    Route::post('getRecentAds', 'AdminController@getRecentAds');
    Route::post('approveAd', 'AdminController@approveAd');
    Route::post('pendingAd', 'AdminController@pendingAd');
    Route::post('rejectAd', 'AdminController@rejectAd');
    Route::post('updateFcmKey', 'AdminController@updateFcmKey');


});

Route::post('getAllCities', 'CitiesController@getAllCities');
Route::post('getAllArea', 'AreaController@getAllArea');
Route::post('importData', 'AdsController@importData');

