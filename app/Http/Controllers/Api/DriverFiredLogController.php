<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DriverFiredLogResource;
use App\Models\DriverFiredLog;
use App\Http\Requests\DriverFiredLogCreateRequest;
use App\Http\Requests\DriverFiredLogUpdateRequest;

class DriverFiredLogController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/driverFiredLog",
     *     summary="Get list of driverFiredLog",
     *     tags={"driverFiredLog"},
     *     security={ {"sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/definitions/DriverFiredLogResource")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="driverFiredLog isn't found",
     *     )
     * )
     */
    public function index()
    {
        if(count(DriverFiredLog::all()) == 0){
            return response(['Message'=>'Can\'t find driverFiredLog'], 400);
        }
        return DriverFiredLogResource::collection(DriverFiredLog::all());
    }

    /**
     * @OA\Post(
     * path="/api/driverFiredLog/{id}",
     * summary="Create driverFiredLog",
     * description="Create new driverFiredLog",
     * operationId="createdriverFiredLog",
     * tags={"driverFiredLog"},
     * security={ {"sanctum": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Send data to create a new driverFiredLog",
     *    @OA\JsonContent(
     *       @OA\Property(property="user", type="object", ref="#/components/schemas/DriverFiredLogCreateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="task", type="object", ref="#/components/schemas/DriverFiredLogResource"),
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
     *      description="Error when creating driverFiredLog",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when creating driverFiredLog")
     *          )
     *      )
     * )
     */
    public function store(DriverFiredLogCreateRequest $request)
    {
        try {
            $new_driverFiredLog = DriverFiredLog::create($request->validated());
            return response([new DriverFiredLogResource($c)], 201);
        }catch (\Exception $e) {
             return response([
                'Message'=>'Error when creating driverFiredLog. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

        /**
     * @OA\Get(
     * path="/api/driverFiredLog/{id}",
     * summary="Get driverFiredLog by id",
     * description="Get driverFiredLog by id",
     * operationId="getdriverFiredLog",
     * tags={"driverFiredLog"},
     * security={ {"sanctum": {}}},
     * @OA\Parameter(
     *    description="ID of driverFiredLog class",
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
     *        @OA\Property(property="driverFiredLog", type="object", ref="#/components/schemas/DriverFiredLogResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="driverFiredLog is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="driverFiredLog is not found")
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
            $driverFiredLog = DriverFiredLog::find($id);
            if($driverFiredLog != null){
                return response([new DriverFiredLogResource($driverFiredLog)], 200);
            }
            return response(['Message'=>'Can\'t find driverFiredLog by id'], 400);
        }catch (\Exception $e) {
            return response([
                'Message'=>'Error when finding driverFiredLog. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

       /**
     * @OA\Patch(
     * path="/api/driverFiredLog/{id}",
     * summary="Update driverFiredLog",
     * description="Update driverFiredLog",
     * operationId="updatedriverFiredLog",
     * tags={"driverFiredLog"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of driverFiredLog",
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
     *    description="Send data to update a driverFiredLog",
     *    @OA\JsonContent(
     *       @OA\Property(property="driverFiredLog", type="object", ref="#/components/schemas/DriverFiredLogUpdateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="driverFiredLog", type="object", ref="#/components/schemas/DriverFiredLogResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="driverFiredLog is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="driverFiredLog is not found")
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
     *      description="Error when updating driverFiredLog",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when updating driverFiredLog")
     *          )
     *      )
     * )
     */
    public function update(DriverFiredLogUpdateRequest $request, string $id)
    {
        try{
            $driverFiredLog = DriverFiredLog::find($id);
            if($driverFiredLog == null){
                return response(['Message'=>'Can\'t find a driverFiredLog with this id'], 400);
            }
            $driverFiredLog->update($request->validated());
            return response([new DriverFiredLogResource($driverFiredLog)], 201);
        } catch(\Exception $e){
           return response([
               'Message'=>'Error when updating driverFiredLog. Please, try again',
               'Error' => $e
           ], 500);
        }
    }

        /**
     * @OA\Delete(
     * path="/api/driverFiredLog/{id}",
     * summary="Delete driverFiredLog by id",
     * description="Delete driverFiredLog by id",
     * operationId="deletedriverFiredLog",
     * tags={"driverFiredLog"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of driverFiredLog",
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
     *        @OA\Property(property="driverFiredLog", type="object", ref="#/components/schemas/DriverFiredLogResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="driverFiredLog is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="driverFiredLog class is not found")
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
        $driverFiredLog = DriverFiredLog::find($id);
        if($driverFiredLog == null){
            return response(['Message'=>'Can\'t find a driverFiredLog with this id'], 400);
        }
        $driverFiredLog->delete();
        return response([new DriverFiredLogResource($driverFiredLog)], 201);
    }
}
