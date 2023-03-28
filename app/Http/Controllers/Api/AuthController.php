<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public static function login($request, $email, $password){
        if(Auth::attempt(['email' => $email, 'password' => $password])){
            return self::tokenServiceCreate($request, $email);
        }
        return response(['Message'=>'Can\'t find users'], 400);
    }

    static function tokenServiceCreate(Request $request,$token_name){
        $token = $request->user()->createToken($token_name);
        return ['token' => $token->plainTextToken];
    }

    public function logout($request){
        $request->user()->currentAccessToken()->delete();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
