<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'msg' => 'Bad request',
                'code' => 400,
                'data' => []
            ], 400);
        }

        // Retrieve the validated input...
        $validated = $validator->validated();
        $validated = $validator->safe()->only(['username', 'password']);

        if (Auth::attempt($validated)) {
            return response([
                'msg' => 'Success',
                'code' => 200,
                'data' => User::select(['name','username','auth_token','role'])->where('username',$validated['username'])->first()
            ]);
        }

        return response([
            'msg' => 'Failed, invalid username / password',
            'code' => 403,
            'data' => []
        ]);
    }
}
