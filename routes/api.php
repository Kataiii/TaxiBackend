<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\CarClassController;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\CarReparingLogController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\DepartamentController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\DriverFiredLogController;
use App\Http\Controllers\Api\DrivingLicenceController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\WorkingShiftController;

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
        'carClass' => CarClassController::class,
        'car' => CarController::class,
        'carReparingLog' => CarReparingLogController::class,
        'company' => CompanyController::class,
        'departament' => DepartamentController::class,
        'driver' => DriverController::class,
        'driverFiredLog' => DriverFiredLogController::class,
        'drivingLicence' => DrivingLicenceController::class,
        'order' => OrderController::class,
        'workingShift' => WorkingShiftController::class
    ]);
});

Route::group(['middleware' => 'auth:sanctum','middleware' => 'admin'], function () {
    Route::apiResources([
        'users' => UserController::class
    ]);
});

Route::post('/login', function (Request $request){
    $email = request('email');
    $password = request('password');
    return(AuthController::login($request, $email, $password));
});

Route::post('/logout', [AuthController::class, 'logout']);
