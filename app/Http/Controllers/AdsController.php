<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Ads;
use App\Banners;
use App\Constants;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AdsController extends Controller
{
    //
    public function storeAd(Request $request)
    {

        if ($request->api_username != Constants::$API_USERNAME || $request->api_password != Constants::$API_PASSOWRD) {
            return response()->json([
                'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong api credentials"
            ], Response::HTTP_OK);
        } else {
            $milliseconds = round(microtime(true) * 1000);
//
            $ad = new Ads();
            $ad->title = $request->title;
            $ad->description = $request->description;
            $ad->price = $request->price;
            $ad->user_id = $request->user_id;
            $ad->time = $milliseconds;
            $ad->city = 'Lahore';
            $ad->area = $request->area;
            $ad->category = $request->category;
            $ad->images = $request->images;
            $ad->status = 'pending';

            $ad->save();


            $admin = DB::table('admin')->where('id', 1)->pluck('fcm_key')->first();

            return response()->json([
                'admin_fcm_key' => $admin
                ,
            ], Response::HTTP_OK);
        }
    }

    public function listOfAds(Request $request)
    {

        if ($request->api_username != Constants::$API_USERNAME || $request->api_password != Constants::$API_PASSOWRD) {
            return response()->json([
                'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong api credentials"
            ], Response::HTTP_OK);
        } else {
            $banners = Banners::all();

            $ads = DB::select('select id,title,price,time,images from ads where status="active" order by id desc ');
            $likes = DB::table('likes')
                ->where('user_id', $request->userId)
                ->get();
            return response()->json([
                'code' => 200, 'message' => "false", 'ads' => $ads, 'banners' => $banners, 'likesList' => $likes->pluck('ad_id')
                ,
            ], Response::HTTP_OK);
        }
    }

    public function getFavoriteListOfAds(Request $request)
    {

        if ($request->api_username != Constants::$API_USERNAME || $request->api_password != Constants::$API_PASSOWRD) {
            return response()->json([
                'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong api credentials"
            ], Response::HTTP_OK);
        } else {
            $milliseconds = round(microtime(true) * 1000);

            $ads = DB::select('select id,title,price,time,images from ads where id in (SELECT ad_id from likes where user_id=' . $request->userId . ') order by id desc ');
            $likes = DB::table('likes')
                ->where('user_id', $request->userId)
                ->get();
            return response()->json([
                'code' => 200, 'message' => "false", 'ads' => $ads, 'likesList' => $likes->pluck('ad_id')
                ,
            ], Response::HTTP_OK);
        }
    }

    public function getAdsInCategory(Request $request)
    {

        if ($request->api_username != Constants::$API_USERNAME || $request->api_password != Constants::$API_PASSOWRD) {
            return response()->json([
                'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong api credentials"
            ], Response::HTTP_OK);
        } else {

            $ads = DB::select('select id,title,price,time,images from ads 
                                      where category = "' . $request->category . '"
                                       AND status ="active" order by id desc');
            $likes = DB::table('likes')
                ->where('user_id', $request->userId)
                ->get();
            return response()->json([
                'code' => 200, 'message' => "false", 'ads' => $ads, 'likesList' => $likes->pluck('ad_id')
                ,
            ], Response::HTTP_OK);
        }
    }

    public function getUserAds(Request $request)
    {

        if ($request->api_username != Constants::$API_USERNAME || $request->api_password != Constants::$API_PASSOWRD) {
            return response()->json([
                'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong api credentials"
            ], Response::HTTP_OK);
        } else {

            $ads = DB::select('select id,title,price,time,images from ads
                                      where user_id = "' . $request->userId . '" 
                                       AND status ="active"
                                       order by id desc');
            $likes = DB::table('likes')
                ->where('user_id', $request->userId)
                ->get();
            return response()->json([
                'code' => 200, 'message' => "false", 'ads' => $ads, 'likesList' => $likes->pluck('ad_id')
                ,
            ], Response::HTTP_OK);
        }
    }

    public function getMyAds(Request $request)
    {

        if ($request->api_username != Constants::$API_USERNAME || $request->api_password != Constants::$API_PASSOWRD) {
            return response()->json([
                'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong api credentials"
            ], Response::HTTP_OK);
        } else {

            $ads = DB::select('SELECT id,title,status,price,time,images from ads 
                                      WHERE user_id = "' . $request->userId . '"
                                      AND (status ="active"  OR status="inactive")
                                      ORDER BY id DESC');

            return response()->json([
                'code' => 200, 'message' => "false", 'ads' => $ads
                ,
            ], Response::HTTP_OK);
        }
    }

    public function changeAdStatus(Request $request)
    {

        if ($request->api_username != Constants::$API_USERNAME || $request->api_password != Constants::$API_PASSOWRD) {
            return response()->json([
                'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong api credentials"
            ], Response::HTTP_OK);
        } else {

            $ad = Ads::find($request->adId);
            $ad->status = $request->status;
            $ad->update();

            $ads = DB::select('SELECT id,title,status,price,time,images from ads 
                                      WHERE user_id = "' . $request->userId . '"
                                      AND (status ="active"  OR status="inactive")
                                      ORDER BY id DESC');

            return response()->json([
                'code' => 200, 'message' => "false", 'ads' => $ads
                ,
            ], Response::HTTP_OK);
        }
    }

    public function getMyPendingAds(Request $request)
    {

        if ($request->api_username != Constants::$API_USERNAME || $request->api_password != Constants::$API_PASSOWRD) {
            return response()->json([
                'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong api credentials"
            ], Response::HTTP_OK);
        } else {

            $ads = DB::select('SELECT id,status ,title,price,time,images from ads 
                                      WHERE user_id = "' . $request->userId . '"
                                      AND status ="pending"  
                                      ORDER BY id DESC');

            return response()->json([
                'code' => 200, 'message' => "false", 'ads' => $ads
                ,
            ], Response::HTTP_OK);
        }
    }

    public function searchResults(Request $request)
    {

        if ($request->api_username != Constants::$API_USERNAME || $request->api_password != Constants::$API_PASSOWRD) {
            return response()->json([
                'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong api credentials"
            ], Response::HTTP_OK);
        } else {

            $ads = DB::select('select id,description,status,title,price,time,images
                                      from ads 
                                      where category like  "%' . $request->category . '%" 
                                      And price > ' . $request->minPrice . ' 
                                      And price < ' . $request->maxPrice . ' 
                                       AND status ="active"
                                      And ( title like "%' . $request->search . '%"  
                                      Or description like "%' . $request->search . '%"   )
                                      
                                      order by id desc');
            $likes = DB::table('likes')
                ->where('user_id', $request->userId)
                ->get();
            return response()->json([
                'code' => 200, 'message' => "false", 'ads' => $ads, 'likesList' => $likes->pluck('ad_id')
                ,
            ], Response::HTTP_OK);
        }
    }

    public function viewAd(Request $request)
    {

        if ($request->api_username != Constants::$API_USERNAME || $request->api_password != Constants::$API_PASSOWRD) {
            return response()->json([
                'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong api credentials"
            ], Response::HTTP_OK);
        } else {
            $ad = Ads::find($request->id);
            $user = User::find($ad->user_id);

            $ad->user = $user;
            $likes = DB::table('likes')
                ->where('user_id', $request->userId)
                ->get();

            return response()->json([
                'code' => 200, 'message' => "false", 'ad' => $ad, 'likesList' => $likes->pluck('ad_id')
                ,
            ], Response::HTTP_OK);
        }
    }
}
