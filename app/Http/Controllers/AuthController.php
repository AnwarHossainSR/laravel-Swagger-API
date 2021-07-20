<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            try {
                /* @var User user */
                $user = Auth::user();
                $token = $user->createToken('admin')->accessToken;

                return \response([
                    'token' => $token
                ],status:200);
            } catch (\Exception $th) {
                return \response(['message' => $th->getMessage()],status:500);
            }
        } else {
            return \response([
                'message' => 'Invalid username or password'],status:401);
        }
    }

    public function registration(UserCreateRequest $request)
    {
        try {
            $user = User::create($request->only('first_name','last_name','email')+[
                'password'=>Hash::make($request->password)
            ]);
            return \response()->json([
                'user'=>$user
            ],status:201);
        } catch (\Exception $th) {
            return \response([
                'message' => 'Something is wrong',
            ], status: 400);
        }
    }

}
