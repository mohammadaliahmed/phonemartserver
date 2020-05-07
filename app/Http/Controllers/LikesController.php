<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Likes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use function sizeof;

class LikesController extends Controller
{
    //
    public function likeAd(Request $request)
    {
        if ($request->api_username != Constants::$API_USERNAME || $request->api_password != Constants::$API_PASSOWRD) {
            return response()->json([
                'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong api credentials"
            ], Response::HTTP_OK);
        } else {

            $likes = DB::table('likes')
                ->where('user_id', $request->userId)
                ->where('ad_id', $request->adId)->get();

            if (sizeof($likes) > 0) {

            } else {
                $like = new Likes();
                $like->ad_id = $request->adId;
                $like->user_id = $request->userId;
                $like->save();

            }
            $likesa = DB::table('likes')
                ->where('user_id', $request->userId)
                ->get();

            return response()->json([
                'code' => 200, 'message' => "false", 'likeList' => $likesa
                ,
            ], Response::HTTP_OK);
        }
    }

    public function unlikeAd(Request $request)
    {
        if ($request->api_username != Constants::$API_USERNAME || $request->api_password != Constants::$API_PASSOWRD) {
            return response()->json([
                'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong api credentials"
            ], Response::HTTP_OK);
        } else {


            $like = DB::table('likes')->where('user_id', $request->userId)->where('ad_id', $request->adId)->delete();

            $likes = DB::table('likes')
                ->where('user_id', $request->userId)
                ->get();

            return response()->json([
                'code' => 200, 'message' => "false", 'likeList' => $likes
                ,
            ], Response::HTTP_OK);
        }
    }
}
