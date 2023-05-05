<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Http\Requests\CarCreateRequest;
use App\Http\Requests\CarUpdateRequest;

class CarController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/car",
     *     summary="Get list of cars",
     *     tags={"car"},
     *     security={ {"sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/definitions/CarResource")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Cars isn't found",
     *     )
     * )
     */
    public function index()
    {
        if(count(Car::all()) == 0){
            return response(['Message'=>'Can\'t find cars'], 400);
        }
        return CarResource::collection(Car::all());
    }

    /**
     * @OA\Post(
     * path="/api/car/{id}",
     * summary="Create car",
     * description="Create new car",
     * operationId="createCar",
     * tags={"car"},
     * security={ {"sanctum": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Send data to create a new car",
     *    @OA\JsonContent(
     *       @OA\Property(property="user", type="object", ref="#/components/schemas/CarCreateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="task", type="object", ref="#/components/schemas/CarResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="401",
     *      description="Unauthorized user",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthorized")
     *        )
     *     ),
     * @OA\Response(
     *      response="500",
     *      description="Error when creating car",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when creating car")
     *          )
     *      )
     * )
     */
    public function store(CarCreateRequest $request)
    {
        try {
            $new_car = Car::create($request->validated());
            return response([new CarResource($new_car)], 201);
        }catch (\Exception $e) {
             return response([
                'Message'=>'Error when creating car. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

        /**
     * @OA\Get(
     * path="/api/car/{id}",
     * summary="Get car by id",
     * description="Get car by id",
     * operationId="getCar",
     * tags={"car"},
     * security={ {"sanctum": {}}},
     * @OA\Parameter(
     *    description="ID of car",
     *    in="path",
     *    name="id",
     *    required=true,
     *    example="1",
     *    @OA\Schema(
     *       type="integer",
     *       format="int64"
     *    )
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="car", type="object", ref="#/components/schemas/CarResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="Car is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Car is not found")
     *    )
     * )
     * ,
     * @OA\Response(
     *      response="401",
     *      description="Unauthorized user",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthorized")
     *        )
     *     )
     * )
     */
    public function show(string $id)
    {
        try {
            $car = Car::find($id);
            if($car != null){
                return response([new CarResource($car)], 200);
            }
            return response(['Message'=>'Can\'t find car by id'], 400);
        }catch (\Exception $e) {
            return response([
                'Message'=>'Error when finding car. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

       /**
     * @OA\Patch(
     * path="/api/car/{id}",
     * summary="Update car",
     * description="Update car",
     * operationId="updateCar",
     * tags={"car"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of car",
     *    in="path",
     *    name="id",
     *    required=true,
     *    example="1",
     *    @OA\Schema(
     *       type="integer",
     *       format="int64"
     *    )
     * ),
     * @OA\RequestBody(
     *    required=true,
     *    description="Send data to update a car",
     *    @OA\JsonContent(
     *       @OA\Property(property="car", type="object", ref="#/components/schemas/CarUpdateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="car", type="object", ref="#/components/schemas/CarResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="Car class is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Car is not found")
     *    )
     * )
     * ,
     * @OA\Response(
     *      response="401",
     *      description="Unauthorized user",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthorized")
     *        )
     *     ),
     * @OA\Response(
     *      response="500",
     *      description="Error when updating car",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when updating car")
     *          )
     *      )
     * )
     */
    public function update(CarUpdateRequest $request, string $id)
    {
        try{
            $car_class = Car::find($id);
            if($car_class == null){
                return response(['Message'=>'Can\'t find a car with this id'], 400);
            }
            $car_class->update($request->validated());
            return response([new CarResource($car)], 201);
        } catch(\Exception $e){
           return response([
               'Message'=>'Error when updating car. Please, try again',
               'Error' => $e
           ], 500);
        }
    }

        /**
     * @OA\Delete(
     * path="/api/car/{id}",
     * summary="Delete car by id",
     * description="Delete car by id",
     * operationId="deleteCar",
     * tags={"car"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of car",
     *    in="path",
     *    name="id",
     *    required=true,
     *    example="1",
     *    @OA\Schema(
     *       type="integer",
     *       format="int64"
     *    )
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="car", type="object", ref="#/components/schemas/CarResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="Car is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Car is not found")
     *    )
     * )
     * ,
     * @OA\Response(
     *      response="401",
     *      description="Unauthorized user",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthorized")
     *        )
     *     )
     *
     * )
     */
    public function destroy(string $id)
    {
        $car = Car::find($id);
        if($car == null){
            return response(['Message'=>'Can\'t find a car with this id'], 400);
        }
        $car->delete();
        return response([new CarResource($car)], 201);
    }
}
