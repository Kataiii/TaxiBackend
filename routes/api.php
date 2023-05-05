<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\CarClassController;

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
    Route::apiResources([
        'leads' => LeadController::class,
        'clients' => ClientController::class,
        'carClass' => CarClassController::class
    ]);

    //Route::get('/clients/phone', [ClientController::class, 'showWithPhone']);
    // Route::get('/test', function(){
    //     return response(['Message'=>"Hello"], 200);
    // })
});

Route::group(['middleware' => 'auth:sanctum','middleware' => 'admin'], function () {
    Route::apiResources([
        'users' => UserController::class
    ]);
});
//Route::get('/users', [UserController::class, 'index']);
// Route::get('/clients/phone', function(){
//         return response(['Message'=>"Hello"], 200);
//     })
// Route::get('/test1', function(){
//     return("Hello");
// })

// Route::get('clients/phone/{phone}', function(Request $request){
//     return(ClientController::showWithPhone($request->phone));
// })


Route::post('/login', function (Request $request){
    $email = request('email');
    $password = request('password');
    return(AuthController::login($request, $email, $password));
});

Route::post('/logout', [AuthController::class, 'logout']);
