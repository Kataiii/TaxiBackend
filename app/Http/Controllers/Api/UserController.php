<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    
    public function index()
    {
        if(count(User::all()) == 0){
            return response(['Message'=>'Can\'t find users'], 400);
        }
        return UserResource::collection(User::all());
    }

    
    public function store(UserCreateRequest $request)
    {
        try {
            $new_user = User::create($request->validated());
            return response([new UserResource($new_user)], 201);
        }catch (\Exception $e) {
            return response([
                'Message'=>'Error when creating user. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

    
    public function show(string $id)
    {
        try {
            $user = User::find($id);
            if($user != null){
                return response([new UserResource($user)], 200);
            }
            return responce(['Message'=>'Can\'t find user by id'], 400);
        }catch (\Exception $e) {
            return response([
                'Message'=>'Error when finding user. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

    
    public function update(UserUpdateRequest $request, string $id)
    {
        try{
            $user = User::find($id);
            if($user == null){
                return response(['Message'=>'Can\'t find a user with this id'], 400);
            }
            $user->update($request->validated());
            return response([new UserResource($user)], 201);
        } catch(\Exception $e){
            return response([
                'Message'=>'Error when updating user. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

    
    public function destroy(string $id)
    {
        $user = User::find($id);
        if($user == null){
            return response(['Message'=>'Can\'t find a user with this id'], 404);
        }
        $user->delete();
        return response([new UserResource($user)], 201);
    }
}
