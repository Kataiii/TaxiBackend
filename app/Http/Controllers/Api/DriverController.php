<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DriverResource;
use App\Models\Driver;
use App\Http\Requests\DriverCreateRequest;
use App\Http\Requests\DriverUpdateRequest;

class DriverController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/driver",
     *     summary="Get list of drivers",
     *     tags={"driver"},
     *     security={ {"sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/definitions/DriverResource")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="drivers isn't found",
     *     )
     * )
     */
    public function index()
    {
        if(count(Driver::all()) == 0){
            return response(['Message'=>'Can\'t find drivers'], 400);
        }
        return D::collection(Driver::all());
    }

    /**
     * @OA\Post(
     * path="/api/driver/{id}",
     * summary="Create driver",
     * description="Create new driver",
     * operationId="createdriver",
     * tags={"driver"},
     * security={ {"sanctum": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Send data to create a new driver",
     *    @OA\JsonContent(
     *       @OA\Property(property="user", type="object", ref="#/components/schemas/DriverCreateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="task", type="object", ref="#/components/schemas/DriverResource"),
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
     *      description="Error when creating driver",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when creating driver")
     *          )
     *      )
     * )
     */
    public function store(DriverCreateRequest $request)
    {
        try {
            $new_driver = Driver::create($request->validated());
            return response([new DriverResource($new_driver)], 201);
        }catch (\Exception $e) {
             return response([
                'Message'=>'Error when creating driver. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

        /**
     * @OA\Get(
     * path="/api/driver/{id}",
     * summary="Get driver by id",
     * description="Get driver by id",
     * operationId="getdriver",
     * tags={"driver"},
     * security={ {"sanctum": {}}},
     * @OA\Parameter(
     *    description="ID of driver",
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
     *        @OA\Property(property="driver", type="object", ref="#/components/schemas/DriverResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="driver is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="driver is not found")
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
            $driver = Driver::find($id);
            if($driver != null){
                return response([new DriverResource($driver)], 200);
            }
            return response(['Message'=>'Can\'t find driver by id'], 400);
        }catch (\Exception $e) {
            return response([
                'Message'=>'Error when finding driver. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

       /**
     * @OA\Patch(
     * path="/api/driver/{id}",
     * summary="Update driver",
     * description="Update driver",
     * operationId="updatedriver",
     * tags={"driver"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of driver",
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
     *    description="Send data to update a driver",
     *    @OA\JsonContent(
     *       @OA\Property(property="driver", type="object", ref="#/components/schemas/DriverUpdateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="driver", type="object", ref="#/components/schemas/DriverResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="driver is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="driver is not found")
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
     *      description="Error when updating driver",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when updating driver")
     *          )
     *      )
     * )
     */
    public function update(DriverUpdateRequest $request, string $id)
    {
        try{
            $driver = Driver::find($id);
            if($driver == null){
                return response(['Message'=>'Can\'t find a driver with this id'], 400);
            }
            $driver->update($request->validated());
            return response([new DriverResource($driver)], 201);
        } catch(\Exception $e){
           return response([
               'Message'=>'Error when updating driver. Please, try again',
               'Error' => $e
           ], 500);
        }
    }

    /**
     * @OA\Delete(
     * path="/api/driver/{id}",
     * summary="Delete driver by id",
     * description="Delete driver by id",
     * operationId="deletedriver",
     * tags={"driver"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of driver",
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
     *        @OA\Property(property="driver", type="object", ref="#/components/schemas/DriverResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="driver is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="driver is not found")
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
        $driver = Driver::find($id);
        if($driver == null){
            return response(['Message'=>'Can\'t find a driver with this id'], 400);
        }
        $driver->delete();
        return response([new DriverResource($driver)], 201);
    }
}
