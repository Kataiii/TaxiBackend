<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\WorkingShiftResource;
use App\Models\WorkingShift;
use App\Http\Requests\WorkingShiftCreateRequest;
use App\Http\Requests\WorkingShiftUpdateRequest;

class WorkingShiftController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/workingShift",
     *     summary="Get list of workingShift",
     *     tags={"workingShift"},
     *     security={ {"sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/definitions/WorkingShiftResource")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="workingShift isn't found",
     *     )
     * )
     */
    public function index()
    {
        if(count(WorkingShift::all()) == 0){
            return response(['Message'=>'Can\'t find workingShift'], 400);
        }
        return WorkingShiftResource::collection(WorkingShift::all());
    }

    /**
     * @OA\Post(
     * path="/api/workingShift/{id}",
     * summary="Create workingShift",
     * description="Create new workingShift",
     * operationId="createworkingShift",
     * tags={"workingShift"},
     * security={ {"sanctum": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Send data to create a new workingShift",
     *    @OA\JsonContent(
     *       @OA\Property(property="user", type="object", ref="#/components/schemas/WorkingShiftCreateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="task", type="object", ref="#/components/schemas/WorkingShiftResource"),
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
     *      description="Error when creating workingShift",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when creating workingShift")
     *          )
     *      )
     * )
     */
    public function store(WorkingShiftCreateRequest $request)
    {
        try {
            $new_workingShift = WorkingShift::create($request->validated());
            return response([new WorkingShiftResource($new_workingShift)], 201);
        }catch (\Exception $e) {
             return response([
                'Message'=>'Error when creating workingShift. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

        /**
     * @OA\Get(
     * path="/api/workingShift/{id}",
     * summary="Get workingShift by id",
     * description="Get workingShift by id",
     * operationId="getworkingShift",
     * tags={"workingShift"},
     * security={ {"sanctum": {}}},
     * @OA\Parameter(
     *    description="ID of workingShift class",
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
     *        @OA\Property(property="workingShift", type="object", ref="#/components/schemas/WorkingShiftResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="workingShift is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="workingShift is not found")
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
            $workingShift = WorkingShift::find($id);
            if($workingShift != null){
                return response([new WorkingShiftResource($workingShift)], 200);
            }
            return response(['Message'=>'Can\'t find workingShift by id'], 400);
        }catch (\Exception $e) {
            return response([
                'Message'=>'Error when finding workingShift. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

       /**
     * @OA\Patch(
     * path="/api/workingShift/{id}",
     * summary="Update workingShift",
     * description="Update workingShift",
     * operationId="updateworkingShift",
     * tags={"workingShift"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of workingShift",
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
     *    description="Send data to update a workingShift",
     *    @OA\JsonContent(
     *       @OA\Property(property="workingShift", type="object", ref="#/components/schemas/WorkingShiftUpdateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="workingShift", type="object", ref="#/components/schemas/WorkingShiftResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="workingShift is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="workingShift is not found")
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
     *      description="Error when updating workingShift",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when updating workingShift")
     *          )
     *      )
     * )
     */
    public function update(WorkingShiftUpdateRequest $request, string $id)
    {
        try{
            $workingShift = WorkingShift::find($id);
            if($workingShift == null){
                return response(['Message'=>'Can\'t find a workingShift with this id'], 400);
            }
            $workingShift->update($request->validated());
            return response([new WorkingShiftResource($workingShift)], 201);
        } catch(\Exception $e){
           return response([
               'Message'=>'Error when updating workingShift. Please, try again',
               'Error' => $e
           ], 500);
        }
    }

        /**
     * @OA\Delete(
     * path="/api/workingShift/{id}",
     * summary="Delete workingShift by id",
     * description="Delete workingShift by id",
     * operationId="deleteworkingShift",
     * tags={"workingShift"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of workingShift",
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
     *        @OA\Property(property="workingShift", type="object", ref="#/components/schemas/WorkingShiftResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="workingShift is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="workingShift class is not found")
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
        $workingShift = WorkingShift::find($id);
        if($workingShift == null){
            return response(['Message'=>'Can\'t find a workingShift with this id'], 400);
        }
        $workingShift->delete();
        return response([new WorkingShiftResource($workingShift)], 201);
    }
}
