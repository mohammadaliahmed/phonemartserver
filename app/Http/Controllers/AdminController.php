<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Ads;
use App\Constants;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //


    public function getRecentAds(Request $request)
    {
        if ($request->api_username != Constants::$API_USERNAME || $request->api_password != Constants::$API_PASSOWRD) {
            return response()->json([
                'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong api credentials"
            ], Response::HTTP_OK);
        } else {

            $ads = DB::select('select id,title,area, price,time,images, status from ads  order by id desc limit 200');

            return response()->json([
                'code' => 200, 'message' => "false", 'ads' => $ads
                ,
            ], Response::HTTP_OK);
        }
    }

    public function approveAd(Request $request)
    {
        if ($request->api_username != Constants::$API_USERNAME || $request->api_password != Constants::$API_PASSOWRD) {
            return response()->json([
                'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong api credentials"
            ], Response::HTTP_OK);
        } else {

            $ad = Ads::find($request->id);
            $ad->status = 'active';
            $ad->update();
            $fcmKey = DB::table('users')->where('id', $ad->user_id)->pluck('fcmKey')->first();


            return response()->json([
                'code' => 200, 'message' => "false", 'fcm_key' => $fcmKey
                ,
            ], Response::HTTP_OK);
        }
    }

    public function rejectAd(Request $request)
    {
        if ($request->api_username != Constants::$API_USERNAME || $request->api_password != Constants::$API_PASSOWRD) {
            return response()->json([
                'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong api credentials"
            ], Response::HTTP_OK);
        } else {

            $ad = Ads::find($request->id);
            $ad->status = 'reject';
            $ad->update();
            $fcmKey = DB::table('users')->where('id', $ad->user_id)->pluck('fcmKey')->first();


            return response()->json([
                'code' => 200, 'message' => "false", 'fcm_key' => $fcmKey
                ,
            ], Response::HTTP_OK);
        }
    }

    public function pendingAd(Request $request)
    {
        if ($request->api_username != Constants::$API_USERNAME || $request->api_password != Constants::$API_PASSOWRD) {
            return response()->json([
                'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong api credentials"
            ], Response::HTTP_OK);
        } else {

            $ad = Ads::find($request->id);
            $ad->status = 'pending';
            $ad->update();


            return response()->json([
                'code' => 200, 'message' => "false"
                ,
            ], Response::HTTP_OK);
        }
    }

    public
    function updateFcmKey(Request $request)
    {

        if ($request->api_username != Constants::$API_USERNAME && $request->api_password != Constants::$API_PASSOWRD) {
            return response()->json([
                'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong api credentials"
            ], Response::HTTP_OK);
        } else {

            $admin = Admin::find(1);
            $admin->fcm_key = $request->fcmKey;
            $admin->update();
            return response()->json([
                'code' => Response::HTTP_OK, 'message' => "false"
            ], Response::HTTP_OK);
        }

    }
}
