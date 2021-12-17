<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function update_token(Request $req)
    {
        $user = $req->user;
        $validator = Validator::make($req->all(), [
            'firebase_token' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'msg' => 'Bad request',
                'code' => 400
            ], 400);
        }

        $firebaseToken = $req->firebase_token;

        $updateToken = User::find($user->id)->update([
            'firebase_token' => $firebaseToken
        ]);

        if ($updateToken) {
            return response([
                'msg' => "Success",
                'code' => 200
            ]);
        }

        return response([
            'msg' => "Failed",
            'code' => 500
        ]);
    }
}
