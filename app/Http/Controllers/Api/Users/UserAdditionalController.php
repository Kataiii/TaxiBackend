<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAdditionalController extends Controller
{
    public function findUserByPhone(Request $request){
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
}
