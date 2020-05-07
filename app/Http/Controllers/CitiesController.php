<?php

namespace App\Http\Controllers;

use App\Cities;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CitiesController extends Controller
{
    //

    public function getAllCities()
    {
        $cities=Cities::all();
        return response()->json([
            'code' => 200, 'message' => "false",'cities'=>$cities->pluck('name')
            ,
        ], Response::HTTP_OK);
    }
}
