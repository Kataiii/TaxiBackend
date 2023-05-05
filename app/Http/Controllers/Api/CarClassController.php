<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CarClassResource;
use App\Models\CarClass;
use App\Http\Requests\CarClassCreateRequest;
use App\Http\Requests\CarClassUpdateRequest;

class CarClassController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/carClass",
     *     summary="Get list of car classes",
     *     tags={"carClass"},
     *     security={ {"sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/definitions/CarClassResource")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Car classes isn't found",
     *     )
     * )
     */
    public function index()
    {
        if(count(CarClass::all()) == 0){
            return response(['Message'=>'Can\'t find car class'], 400);
        }
        return CarClassResource::collection(CarClass::all());
    }

    /**
     * @OA\Post(
     * path="/api/carClass/{id}",
     * summary="Create car class",
     * description="Create new car class",
     * operationId="createCarClass",
     * tags={"carClass"},
     * security={ {"sanctum": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Send data to create a new car class",
     *    @OA\JsonContent(
     *       @OA\Property(property="user", type="object", ref="#/components/schemas/CarClassCreateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="task", type="object", ref="#/components/schemas/CarClassResource"),
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
     *      description="Error when creating carClass",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when creating carClass")
     *          )
     *      )
     * )
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
     * @OA\Get(
     * path="/api/carClass/{id}",
     * summary="Get car class by id",
     * description="Get car class by id",
     * operationId="getCarClass",
     * tags={"carClass"},
     * security={ {"sanctum": {}}},
     * @OA\Parameter(
     *    description="ID of car class",
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
     *        @OA\Property(property="carClass", type="object", ref="#/components/schemas/CarClassResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="Car class is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Car class is not found")
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
     * @OA\Patch(
     * path="/api/carClass/{id}",
     * summary="Update car class",
     * description="Update car class",
     * operationId="updateCarClass",
     * tags={"carClass"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of car class",
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
     *    description="Send data to update a car class",
     *    @OA\JsonContent(
     *       @OA\Property(property="carClass", type="object", ref="#/components/schemas/CarClassUpdateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="carClass", type="object", ref="#/components/schemas/CarClassResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="Car class is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Car class is not found")
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
     *      description="Error when updating car class",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when updating car class")
     *          )
     *      )
     * )
     */
    public function update(CarClassUpdateRequest $request, string $id)
    {
        try{
            $car_class = CarClass::find($id);
            if($car_class == null){
                return response(['Message'=>'Can\'t find a car class with this id'], 400);
            }
            $car_class->update($request->validated());
            return response([new CarClassResource($carClass)], 201);
        } catch(\Exception $e){
           return response([
               'Message'=>'Error when updating car class. Please, try again',
               'Error' => $e
           ], 500);
        }
    }

        /**
     * @OA\Delete(
     * path="/api/carClass/{id}",
     * summary="Delete car class by id",
     * description="Delete car class by id",
     * operationId="deleteCarClass",
     * tags={"carClass"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of car class",
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
     *        @OA\Property(property="carClass", type="object", ref="#/components/schemas/CarClassResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="Car class is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Car class is not found")
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
        $carClass = CarClass::find($id);
        if($carClass == null){
            return response(['Message'=>'Can\'t find a car class with this id'], 400);
        }
        $carClass->delete();
        return response([new CarClassResource($carClass)], 201);
    }
}
