<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CarReparingLogResource;
use App\Models\CarReparingLog;
use App\Http\Requests\CarReparingLogCreateRequest;
use App\Http\Requests\CarReparingLogUpdateRequest;

class CarReparingLogController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/carReparingLog",
     *     summary="Get list of carReparingLogs",
     *     tags={"carReparingLog"},
     *     security={ {"sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/definitions/ReparingLog")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="CarReparingLogs isn't found",
     *     )
     * )
     */
    public function index()
    {
        if(count(CarReparingLog::all()) == 0){
            return response(['Message'=>'Can\'t find carReparingLogs'], 400);
        }
        return ReparingLog::collection(CarReparingLog::all());
    }

    /**
     * @OA\Post(
     * path="/api/carReparingLog/{id}",
     * summary="Create carReparingLog",
     * description="Create new carReparingLog",
     * operationId="createCarReparingLog",
     * tags={"carReparingLog"},
     * security={ {"sanctum": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Send data to create a new carReparingLog",
     *    @OA\JsonContent(
     *       @OA\Property(property="carReparingLog", type="object", ref="#/components/schemas/CarReparingLogCreateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="task", type="object", ref="#/components/schemas/CarReparingLog"),
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
     *      description="Error when creating carReparingLog",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when creating carReparingLog")
     *          )
     *      )
     * )
     */
    public function store(CarReparingLogCreateRequest $request)
    {
        try {
            $new_carReparingLog = CarReparingLog::create($request->validated());
            return response([new CarReparingLog($new_carReparingLog)], 201);
        }catch (\Exception $e) {
             return response([
                'Message'=>'Error when creating carReparingLog. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

        /**
     * @OA\Get(
     * path="/api/carReparingLog/{id}",
     * summary="Get carReparingLog by id",
     * description="Get carReparingLog by id",
     * operationId="getCarReparingLog",
     * tags={"carReparingLog"},
     * security={ {"sanctum": {}}},
     * @OA\Parameter(
     *    description="ID of carReparingLog",
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
     *        @OA\Property(property="carReparingLog", type="object", ref="#/components/schemas/CarReparingLog"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="CarReparingLog is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="CarReparingLog is not found")
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
            $carReparingLog = CarReparingLog::find($id);
            if($carReparingLog != null){
                return response([new CarReparingLog($carReparingLog)], 200);
            }
            return response(['Message'=>'Can\'t find carReparingLog by id'], 400);
        }catch (\Exception $e) {
            return response([
                'Message'=>'Error when finding carReparingLog. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

       /**
     * @OA\Patch(
     * path="/api/carReparingLog/{id}",
     * summary="Update carReparingLog",
     * description="Update carReparingLog",
     * operationId="updateCarReparingLog",
     * tags={"carReparingLog"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of carReparingLog",
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
     *    description="Send data to update a carReparingLog",
     *    @OA\JsonContent(
     *       @OA\Property(property="carReparingLog", type="object", ref="#/components/schemas/CarReparingLogUpdateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="carReparingLog", type="object", ref="#/components/schemas/CarReparingLog"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="CarReparingLog class is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="CarReparingLog is not found")
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
     *      description="Error when updating carReparingLog",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when updating carReparingLog")
     *          )
     *      )
     * )
     */
    public function update(RepairingLog $request, string $id)
    {
        try{
            $carReparingLog_class = CarReparingLog::find($id);
            if($carReparingLog_class == null){
                return response(['Message'=>'Can\'t find a carReparingLog with this id'], 400);
            }
            $carReparingLog_class->update($request->validated());
            return response([new CarReparingLog($carReparingLog)], 201);
        } catch(\Exception $e){
           return response([
               'Message'=>'Error when updating carReparingLog. Please, try again',
               'Error' => $e
           ], 500);
        }
    }

        /**
     * @OA\Delete(
     * path="/api/carReparingLog/{id}",
     * summary="Delete carReparingLog by id",
     * description="Delete carReparingLog by id",
     * operationId="deleteCarReparingLog",
     * tags={"carReparingLog"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of carReparingLog",
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
     *        @OA\Property(property="carReparingLog", type="object", ref="#/components/schemas/CarReparingLog"),
     *     )
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="CarReparingLog is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="CarReparingLog is not found")
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
        $carReparingLog = CarReparingLog::find($id);
        if($carReparingLog == null){
            return response(['Message'=>'Can\'t find a carReparingLog with this id'], 400);
        }
        $carReparingLog->delete();
        return response([new ReparingLog($carReparingLog)], 201);
    }
}
