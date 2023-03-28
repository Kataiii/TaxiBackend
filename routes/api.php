<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ClientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function (){
    //Тут запросы
    Route::apiResources([
        'users' => UserController::class,
        'clients' => ClientController::class
    ]);

    //Route::post('/users', [UserController::class, 'store']);
});
//Route::get('/users', [UserController::class, 'index']);

// Route::get('/test1', function(){
//     return("Hello");
// })


Route::post('/login', function (Request $request){
    $email = request('email');
    $password = request('password');
    return(AuthController::login($request, $email, $password));
});

Route::post('/logout', [AuthController::class, 'logout']);
