<?php

namespace App\Http\Controllers;

use App\Constants;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;


class UserController extends Controller
{
    //
    public function login(Request $request)
    {

        if ($request->api_username != Constants::$API_USERNAME || $request->api_password != Constants::$API_PASSOWRD) {
            return response()->json([
                'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong api credentials"
            ], Response::HTTP_OK);
        } else {

            $abc = Hash::make($request->password);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = DB::table('users')->where('email', $request->email)->first();
                return response()->json([
                    'code' => 200, 'message' => "false", 'user' => $user
                    ,
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'code' => 302, 'message' => 'Wrong credentials',
                ], Response::HTTP_OK);
            }
        }

    }

    public function register(Request $request)
    {

        if ($request->api_username != Constants::$API_USERNAME || $request->api_password != Constants::$API_PASSOWRD) {
            return response()->json([
                'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong api credentials"
            ], Response::HTTP_FORBIDDEN);
        } else {
            $user = DB::table('users')
                ->where('email', $request->email)
                ->orWhere('phone', $request->phone)
                ->first();
            if ($user != null) {
                return response()->json([
                    'code' => 302, 'message' => 'Account already exist',
                ], Response::HTTP_OK);
            } else {

                if ($request->name == null) {
                    return response()->json([
                        'code' => 302, 'message' => 'Empty params',
                    ], Response::HTTP_OK);
                } else {
                    $abc = Hash::make($request->password);
                    $user = new User();
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->password = $abc;
                    $user->phone = $request->phone;
                    $user->city = $request->city;
                    $user->save();
                    return response()->json([
                        'code' => Response::HTTP_OK, 'message' => "false", 'user' => $user
                        ,
                    ], Response::HTTP_OK);
                }

            }

        }
    }

    public function update(Request $request)
    {

        if ($request->api_username != Constants::$API_USERNAME || $request->api_password != Constants::$API_PASSOWRD) {
            return response()->json([
                'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong api credentials"
            ], Response::HTTP_FORBIDDEN);
        } else {

            $user = User::find($request->userId);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->city = $request->city;
            $user->update();
            return response()->json([
                'code' => Response::HTTP_OK, 'message' => "false", 'user' => $user
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
            $user = User::find($request->id);
            $user->fcmKey = $request->fcmKey;
            $user->update();
            return response()->json([
                'code' => Response::HTTP_OK, 'message' => "false", 'user' => $user
            ], Response::HTTP_OK);
        }
    }
}
