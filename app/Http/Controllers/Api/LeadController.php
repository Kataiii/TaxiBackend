<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Http\Resources\LeadResource;
use App\Http\Requests\LeadCreateRequest;
use App\Http\Requests\LeadUpdateRequest;

class LeadController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/lead",
     *     summary="Get list of leads",
     *     tags={"lead"},
     *     security={ {"sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/definitions/Lead")
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
        if(count(Lead::all()) == 0){
            return response(['Message'=>'Can\'t find leads'], 400);
        }
        return LeadResource::collection(Lead::all());
    }

    /**
     * @OA\Post(
     * path="/api/lead/{id}",
     * summary="Create lead",
     * description="Create new lead",
     * operationId="createlead",
     * tags={"lead"},
     * security={ {"sanctum": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Send data to create a new lead",
     *    @OA\JsonContent(
     *       @OA\Property(property="user", type="object", ref="#/components/schemas/LeadCreateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="task", type="object", ref="#/components/schemas/LeadResource"),
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
     *      description="Error when creating order",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when creating lead")
     *          )
     *      )
     * )
     */
    public function store(LeadCreateRequest $request)
    {
        try {
            $new_lead = Lead::create($request->validated());
            return response([new LeadResource($new_lead)], 201);
        }catch (\Exception $e) {
             return response([
                'Message'=>'Error when creating lead. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

    /**
     * @OA\Get(
     * path="/api/lead/{id}",
     * summary="Get lead by id",
     * description="Get lead by id",
     * operationId="getlead",
     * tags={"lead"},
     * security={ {"sanctum": {}}},
     * @OA\Parameter(
     *    description="ID of lead",
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
     *        @OA\Property(property="lead", type="object", ref="#/components/schemas/LeadResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="lead is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="lead is not found")
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
            $lead = Lead::find($id);
            if($lead != null){
                return response([new LeadResource($lead)], 200);
            }
            return response(['Message'=>'Can\'t find lead by id'], 400);
        }catch (\Exception $e) {
            return response([
                'Message'=>'Error when finding lead. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

     /**
     * @OA\Patch(
     * path="/api/lead/{id}",
     * summary="Update lead",
     * description="Update lead",
     * operationId="updatelead",
     * tags={"lead"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of lead",
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
     *    description="Send data to update a lead",
     *    @OA\JsonContent(
     *       @OA\Property(property="lead", type="object", ref="#/components/schemas/LeadUpdateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="lead", type="object", ref="#/components/schemas/LeadResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="lead is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="lead is not found")
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
     *      description="Error when updating lead",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when updating lead")
     *          )
     *      )
     * )
     */
    public function update(LeadUpdateRequest $request, string $id)
    {
        try{
            $lead = Lead::find($id);
            if($lead == null){
                return response(['Message'=>'Can\'t find a lead with this id'], 400);
            }
            $lead->update($request->validated());
            return response([new LeadResource($lead)], 201);
        } catch(\Exception $e){
           return response([
               'Message'=>'Error when updating lead. Please, try again',
               'Error' => $e
           ], 500);
        }
    }

    /**
     * @OA\Delete(
     * path="/api/lead/{id}",
     * summary="Delete lead by id",
     * description="Delete lead by id",
     * operationId="deletelead",
     * tags={"lead"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of lead",
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
     *        @OA\Property(property="lead", type="object", ref="#/components/schemas/LeadResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="lead is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="lead class is not found")
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
        $lead = Lead::find($id);
        if($lead == null){
            return response(['Message'=>'Can\'t find a lead with this id'], 400);
        }
        $lead->delete();
        return response([new LeadResource($lead)], 201);
    }
}
