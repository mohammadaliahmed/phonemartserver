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

    Route::post('register', [\App\Http\Controllers\UserController::class, 'register']);
    Route::post('login', [\App\Http\Controllers\UserController::class, 'login']);
    Route::post('updateProfilePicture', [\App\Http\Controllers\UserController::class, 'updateProfilePicture']);
    Route::post('updateFcmKey', [\App\Http\Controllers\UserController::class, 'updateFcmKey']);
    Route::post('update', [\App\Http\Controllers\UserController::class, 'update']);
    Route::post('register', [\App\Http\Controllers\UserController::class, 'register']);
    Route::post('searchUsers', [\App\Http\Controllers\UserController::class, 'searchUsers']);
    Route::post('userProfile', [\App\Http\Controllers\UserController::class, 'userProfile']);

});
Route::group(['prefix' => 'ad'], function () {


    Route::post('storeAd', [\App\Http\Controllers\AdsController::class, 'storeAd']);
    Route::post('listOfAds', [\App\Http\Controllers\AdsController::class, 'listOfAds']);
    Route::post('viewAd', [\App\Http\Controllers\AdsController::class, 'viewAd']);
    Route::post('getAdsInCategory', [\App\Http\Controllers\AdsController::class, 'getAdsInCategory']);
    Route::post('getUserAds', [\App\Http\Controllers\AdsController::class, 'getUserAds']);
    Route::post('getMyAds', [\App\Http\Controllers\AdsController::class, 'getMyAds']);
    Route::post('browseAds', [\App\Http\Controllers\AdsController::class, 'browseAds']);
    Route::post('getMyPendingAds', [\App\Http\Controllers\AdsController::class, 'getMyPendingAds']);
    Route::post('changeAdStatus', [\App\Http\Controllers\AdsController::class, 'changeAdStatus']);
    Route::post('searchResults', [\App\Http\Controllers\AdsController::class, 'searchResults']);
    Route::post('filterResults', [\App\Http\Controllers\AdsController::class, 'filterResults']);
    Route::post('getFavoriteListOfAds', [\App\Http\Controllers\AdsController::class, 'getFavoriteListOfAds']);

});
Route::group(['prefix' => 'like'], function () {


    Route::post('likeAd', [\App\Http\Controllers\LikesController::class, 'likeAd']);
    Route::post('unlikeAd', [\App\Http\Controllers\LikesController::class, 'unlikeAd']);



});
Route::group(['prefix' => 'admin'], function () {

    Route::post('getRecentAds', [\App\Http\Controllers\AdminController::class, 'getRecentAds']);
    Route::post('approveAd', [\App\Http\Controllers\AdminController::class, 'approveAd']);
    Route::post('pendingAd', [\App\Http\Controllers\AdminController::class, 'pendingAd']);
    Route::post('rejectAd', [\App\Http\Controllers\AdminController::class, 'rejectAd']);
    Route::post('updateFcmKey', [\App\Http\Controllers\AdminController::class, 'updateFcmKey']);


});


Route::post('getAllCities', [\App\Http\Controllers\CitiesController::class, 'getAllCities']);
Route::post('getAllArea', [\App\Http\Controllers\AreaController::class, 'getAllArea']);
Route::post('importData', [\App\Http\Controllers\AdsController::class, 'importData']);



