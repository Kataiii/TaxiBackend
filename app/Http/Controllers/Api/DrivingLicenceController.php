<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DrivingLicenceResource;
use App\Models\DrivingLicence;
use App\Http\Requests\DrivingLicenceCreateRequest;
use App\Http\Requests\DrivingLicenceUpdateRequest;

class DrivingLicenceController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/drivingLicence",
     *     summary="Get list of drivingLicence",
     *     tags={"drivingLicence"},
     *     security={ {"sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/definitions/DrivingLicenceResource")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="drivingLicence isn't found",
     *     )
     * )
     */
    public function index()
    {
        if(count(DrivingLicence::all()) == 0){
            return response(['Message'=>'Can\'t find drivingLicence'], 400);
        }
        return DrivingLicenceResource::collection(DrivingLicence::all());
    }

    /**
     * @OA\Post(
     * path="/api/drivingLicence/{id}",
     * summary="Create drivingLicence",
     * description="Create new drivingLicence",
     * operationId="createdrivingLicence",
     * tags={"drivingLicence"},
     * security={ {"sanctum": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Send data to create a new drivingLicence",
     *    @OA\JsonContent(
     *       @OA\Property(property="user", type="object", ref="#/components/schemas/DrivingLicenceCreateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="task", type="object", ref="#/components/schemas/DrivingLicenceResource"),
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
     *      description="Error when creating drivingLicence",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when creating drivingLicence")
     *          )
     *      )
     * )
     */
    public function store(DrivingLicenceCreateRequest $request)
    {
        try {
            $new_drivingLicence = DrivingLicence::create($request->validated());
            return response([new DrivingLicenceResource($new_drivingLicence)], 201);
        }catch (\Exception $e) {
             return response([
                'Message'=>'Error when creating drivingLicence. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

        /**
     * @OA\Get(
     * path="/api/drivingLicence/{id}",
     * summary="Get drivingLicence by id",
     * description="Get drivingLicence by id",
     * operationId="getdrivingLicence",
     * tags={"drivingLicence"},
     * security={ {"sanctum": {}}},
     * @OA\Parameter(
     *    description="ID of drivingLicence class",
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
     *        @OA\Property(property="drivingLicence", type="object", ref="#/components/schemas/DrivingLicenceResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="drivingLicence is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="drivingLicence is not found")
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
            $drivingLicence = DrivingLicence::find($id);
            if($drivingLicence != null){
                return response([new DrivingLicenceResource($drivingLicence)], 200);
            }
            return response(['Message'=>'Can\'t find drivingLicence by id'], 400);
        }catch (\Exception $e) {
            return response([
                'Message'=>'Error when finding drivingLicence. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

       /**
     * @OA\Patch(
     * path="/api/drivingLicence/{id}",
     * summary="Update drivingLicence",
     * description="Update drivingLicence",
     * operationId="updatedrivingLicence",
     * tags={"drivingLicence"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of drivingLicence",
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
     *    description="Send data to update a drivingLicence",
     *    @OA\JsonContent(
     *       @OA\Property(property="drivingLicence", type="object", ref="#/components/schemas/DrivingLicenceUpdateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="drivingLicence", type="object", ref="#/components/schemas/DrivingLicenceResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="drivingLicence is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="drivingLicence is not found")
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
     *      description="Error when updating drivingLicence",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when updating drivingLicence")
     *          )
     *      )
     * )
     */
    public function update(DrivingLicenceUpdateRequest $request, string $id)
    {
        try{
            $drivingLicence = DrivingLicence::find($id);
            if($drivingLicence == null){
                return response(['Message'=>'Can\'t find a drivingLicence with this id'], 400);
            }
            $drivingLicence->update($request->validated());
            return response([new DrivingLicenceResource($drivingLicence)], 201);
        } catch(\Exception $e){
           return response([
               'Message'=>'Error when updating drivingLicence. Please, try again',
               'Error' => $e
           ], 500);
        }
    }

        /**
     * @OA\Delete(
     * path="/api/drivingLicence/{id}",
     * summary="Delete drivingLicence by id",
     * description="Delete drivingLicence by id",
     * operationId="deletedrivingLicence",
     * tags={"drivingLicence"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of drivingLicence",
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
     *        @OA\Property(property="drivingLicence", type="object", ref="#/components/schemas/DrivingLicenceResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="drivingLicence is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="drivingLicence class is not found")
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
        $drivingLicence = DrivingLicence::find($id);
        if($drivingLicence == null){
            return response(['Message'=>'Can\'t find a drivingLicence with this id'], 400);
        }
        $drivingLicence->delete();
        return response([new DrivingLicenceResource($drivingLicence)], 201);
    }
}
