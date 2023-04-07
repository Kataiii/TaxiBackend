<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CarClassResource;
use App\Models\CarClass;
use App\Http\Requests\CarClassCreateRequest;
use App\Http\Requests\CarClassUpdateRequest;

class CarClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(count(CarClass::all()) == 0){
            return response(['Message'=>'Can\'t find car class'], 400);
        }
        return CarClassResource::collection(CarClass::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarClassCreateRequest $request)
    {
        try {
            $new_car_class = CarClass::create($request->validated());
            return response([new CarClassResource($new_car_class)], 201);
        }catch (\Exception $e) {
             return response([
                'Message'=>'Error when creating car class. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $carClass = CarClass::find($id);
            if($carClass != null){
                return response([new CarClassResource($lead)], 200);
            }
            return response(['Message'=>'Can\'t find car class by id'], 400);
        }catch (\Exception $e) {
            return response([
                'Message'=>'Error when finding car class. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarClassUpdateRequest $request, string $id)
    {
        try{
            $car_class = CarClass::find($id);
            if($car_class == null){
                return response(['Message'=>'Can\'t find a car class with this id'], 400);
            }
            $car_class->update($request->validated());
            return response([new CarClassResource($client)], 201);
        } catch(\Exception $e){
           return response([
               'Message'=>'Error when updating car class. Please, try again',
               'Error' => $e
           ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $carClass = CarClass::find($id);
        if($carClass == null){
            return response(['Message'=>'Can\'t find a car class with this id'], 400);
        }
        $carClass->delete();
        return response([new CarClassResource($carClass)], 201);
    }
}
