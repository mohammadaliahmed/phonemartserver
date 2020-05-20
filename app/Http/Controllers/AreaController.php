<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    //
    public function getAllArea(Request $request)
    {
        $area = DB::table('area')->where('city_name', $request->cityName)->get();
        return response()->json([
            'code' => 200, 'message' => "false", 'area' => $area->pluck('area')
            ,
        ], Response::HTTP_OK);
    }

    public function insertArea(Request $request)
    {

        
    }
}
