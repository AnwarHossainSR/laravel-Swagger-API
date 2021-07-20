<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

/**
 * @OA\Get(
 *      path="/users",
 *      security={{ "bearerAuth":{} }},
 *      summary="Get list of users",
 *      description="Returns list of users",
 *      @OA\Response(
 *          response=200,
 *          description="successful operation for user collection"
 *       )
 *   )
 *
 */
    public function index()
    {
        try {
            $users = User::paginate();
            return \response([
                'users'=>$users
            ],status:200);
        } catch (\Throwable $th) {
            return \response([
                'msg'=>$th->getMessage()
            ],status:500);
        }
    }

    public function show($id)
    {
        try {
            $user = User::find($id);
            if($user){
                return \response()->json([
                    'status'=>200,
                    'user'=>$user
                ]);
            }else{
                return \response()->json([
                    'status'=>404,
                    'user'=>'user not found'
                ]);
            }

        } catch (\Throwable $th) {
            return \response()->json([
                'status'=>500,
                'msg'=>$th->getMessage()
            ]);
        }
    }
    public function store(UserCreateRequest $request)
    {
        try {
            $user = User::create($request->only('first_name','last_name','email')+[
                'password'=>Hash::make($request->password)
            ]);
            return \response()->json([
                'status'=>201,
                'user'=>$user
            ]);
        } catch (\Throwable $th) {
            return \response()->json([
                'status'=>500,
                'msg'=>$th->getMessage()
            ]);
        }
    }
    public function update(UserUpdateRequest $request,$id)
    {
        try {
            $user = User::find($id);
            if($user){
                $user->update($request->only('first_name','last_name','email'));
                return \response()->json([
                    'status'=>204,
                    'user'=>$user
                ]);
            }else{
                return \response()->json([
                    'status'=>500,
                    'msg'=>'user not found'
                ]);
            }

        } catch (\Throwable $th) {
            return \response()->json([
                'status'=>500,
                'msg'=>$th->getMessage()
            ]);
        }
    }
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                $user->delete();
                return \response()->json([
                    'status'=>200
                ]);
            } else {
                return \response()->json([
                    'status'=>404,
                    'user'=>'Not Found'
                ]);
            }

        } catch (\Throwable $th) {
            return \response()->json([
                'status'=>500,
                'msg'=>$th->getMessage()
            ]);
        }
    }
}
