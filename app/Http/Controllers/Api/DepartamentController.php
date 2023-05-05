<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DepartamentResource;
use App\Models\Departament;
use App\Http\Requests\DepartamentCreateRequest;
use App\Http\Requests\DepartamentUpdateRequest;

class DepartamentController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/departament",
     *     summary="Get list of departaments",
     *     tags={"departament"},
     *     security={ {"sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/definitions/DepartamentResource")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Departaments isn't found",
     *     )
     * )
     */
    public function index()
    {
        if(count(Departament::all()) == 0){
            return response(['Message'=>'Can\'t find departaments'], 400);
        }
        return DepartamentResource::collection(Departament::all());
    }

    /**
     * @OA\Post(
     * path="/api/departament/{id}",
     * summary="Create departament",
     * description="Create new departament",
     * operationId="createDepartament",
     * tags={"departament"},
     * security={ {"sanctum": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Send data to create a new departament",
     *    @OA\JsonContent(
     *       @OA\Property(property="user", type="object", ref="#/components/schemas/DepartamentCreateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="task", type="object", ref="#/components/schemas/DepartamentResource"),
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
     *      description="Error when creating Departament",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when creating Departament")
     *          )
     *      )
     * )
     */
    public function store(DepartamentCreateRequest $request)
    {
        try {
            $new_departament = Departament::create($request->validated());
            return response([new DepartamentResource($new_departament)], 201);
        }catch (\Exception $e) {
             return response([
                'Message'=>'Error when creating departament. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

        /**
     * @OA\Get(
     * path="/api/departament/{id}",
     * summary="Get departament by id",
     * description="Get departament by id",
     * operationId="getDepartament",
     * tags={"departament"},
     * security={ {"sanctum": {}}},
     * @OA\Parameter(
     *    description="ID of departament",
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
     *        @OA\Property(property="Departament", type="object", ref="#/components/schemas/DepartamentResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="departament is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="departament is not found")
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
            $departament = Departament::find($id);
            if($departament != null){
                return response([new DepartamentResource($departament)], 200);
            }
            return response(['Message'=>'Can\'t find departament by id'], 400);
        }catch (\Exception $e) {
            return response([
                'Message'=>'Error when finding departament. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

       /**
     * @OA\Patch(
     * path="/api/departament/{id}",
     * summary="Update departament",
     * description="Update departament",
     * operationId="updateDepartament",
     * tags={"departament"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of departament",
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
     *    description="Send data to update a departament",
     *    @OA\JsonContent(
     *       @OA\Property(property="Departament", type="object", ref="#/components/schemas/DepartamentUpdateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="Departament", type="object", ref="#/components/schemas/DepartamentResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="departament is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="departament is not found")
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
     *      description="Error when updating departament",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when updating departament")
     *          )
     *      )
     * )
     */
    public function update(DepartamentUpdateRequest $request, string $id)
    {
        try{
            $departament = Departament::find($id);
            if($departament == null){
                return response(['Message'=>'Can\'t find a departament with this id'], 400);
            }
            $departament->update($request->validated());
            return response([new DepartamentResource($departament)], 201);
        } catch(\Exception $e){
           return response([
               'Message'=>'Error when updating departament. Please, try again',
               'Error' => $e
           ], 500);
        }
    }

    /**
     * @OA\Delete(
     * path="/api/departament/{id}",
     * summary="Delete departament by id",
     * description="Delete departament by id",
     * operationId="deleteDepartament",
     * tags={"departament"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of departament",
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
     *        @OA\Property(property="Departament", type="object", ref="#/components/schemas/DepartamentResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="departament is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="departament is not found")
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
        $departament = Departament::find($id);
        if($departament == null){
            return response(['Message'=>'Can\'t find a departament with this id'], 400);
        }
        $departament->delete();
        return response([new DepartamentResource($departament)], 201);
    }
}
