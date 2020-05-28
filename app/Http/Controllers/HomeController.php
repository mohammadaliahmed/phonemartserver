<?php

namespace App\Http\Controllers;

use App\Ads;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $categories = DB::table('categories')->get();

        $ads = DB::select('select id,city,title,price,time,images from ads where status="active" order by id desc limit 200');

        foreach ($ads as $ad) {
            $img = explode(',', $ad->images);
            $ad->img = $img[0] . ';s=300x300';

//            $dt = new DateTime(''.$ad->time);  // convert UNIX timestamp to PHP DateTime
//            $ad->time= $dt->format('Y-m-d H:i:s');
            $epoch = $ad->time;
            $dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
            $ad->time = $dt->format('d-M');
            if (strlen($ad->title) > 12) {
                $result = mb_substr($ad->title, 0, 20);

                $ad->title = $result;
            }

        }

//        return response()->json([
//            'code' => 200, 'message' => "false", 'ads' => $ads
//            ,
//        ], Response::HTTP_OK);
        return view('home')
            ->with('categories', $categories)
            ->with('ads', $ads);
    }


    public function showCategoryAds(Request $request, $category)
    {


        $ads = DB::select('select id,city,title,price,time,images from ads where status="active" and category like "%' . $category . '%"  order by id desc limit 200');

        foreach ($ads as $ad) {
            $img = explode(',', $ad->images);
            $ad->img = $img[0] . ';s=300x300';

//            $dt = new DateTime(''.$ad->time);  // convert UNIX timestamp to PHP DateTime
//            $ad->time= $dt->format('Y-m-d H:i:s');
            $epoch = $ad->time;
            $dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
            $ad->time = $dt->format('d-M');
            if (strlen($ad->title) > 12) {
                $result = mb_substr($ad->title, 0, 20);

                $ad->title = $result;
            }

        }

//        return response()->json([
//            'code' => 200, 'message' => "false", 'ads' => $ads
//            ,
//        ], Response::HTTP_OK);
        return view('category')
            ->with('category', $category)
            ->with('ads', $ads);
    }

    public function showUserAds(Request $request, $id)
    {


        $ads = DB::select('select id,city,title,price,time,images from ads where status="active" and user_id= ' . $id . '  order by id desc limit 200');

        foreach ($ads as $ad) {
            $img = explode(',', $ad->images);
            $ad->img = $img[0] . ';s=300x300';

//            $dt = new DateTime(''.$ad->time);  // convert UNIX timestamp to PHP DateTime
//            $ad->time= $dt->format('Y-m-d H:i:s');
            $epoch = $ad->time;
            $dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
            $ad->time = $dt->format('d-M');
            if (strlen($ad->title) > 12) {
                $result = mb_substr($ad->title, 0, 20);

                $ad->title = $result;
            }

        }
        $user = User::find($id);


//        return response()->json([
//            'code' => 200, 'message' => "false", 'ads' => $ads
//            ,
//        ], Response::HTTP_OK);
        return view('userads')
            ->with('user', $user)
            ->with('ads', $ads);
    }


    public function viewad(Request $request, $id)
    {
        $ad = Ads::find($id);
        $epoch = $ad->time;
        $dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
        $ad->time = $dt->format('d-M');

        $images = explode(',', $ad->images);


        $user = User::find($ad->user_id);


        $relatedAds = DB::table('ads')
            ->where('category', $ad->category)
            ->get();
        foreach ($relatedAds as $ad) {
            $img = explode(',', $ad->images);
            $ad->img = $img[0] . ';s=300x300';

//            $dt = new DateTime(''.$ad->time);  // convert UNIX timestamp to PHP DateTime
//            $ad->time= $dt->format('Y-m-d H:i:s');
            $epoch = $ad->time;
            $dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
            $ad->time = $dt->format('d-M');
            if (strlen($ad->title) > 12) {
                $result = mb_substr($ad->title, 0, 15);

                $ad->title = $result;
            }
        }
        return view('viewad')
            ->with('ad', $ad)
            ->with('images', $images)
            ->with('user', $user)
            ->with('relatedAds', $relatedAds);

    }
}
