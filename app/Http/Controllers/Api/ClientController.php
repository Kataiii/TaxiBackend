<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Http\Requests\ClientCreateRequest;
use App\Http\Requests\ClientUpdateRequest;

class ClientController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/clients",
     *     summary="Get list of clients",
     *     tags={"clients"},
     *     security={ {"sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/definitions/ClientResource")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Clients isn't found",
     *     )
     * )
     */
    public function index()
    {
        if(count(Client::all()) == 0){
            return response(['Message'=>'Can\'t find clients'], 400);
        }
        return ClientResource::collection(Client::all());
    }

   
    /**
     * @OA\Post(
     * path="/api/clients/{id}",
     * summary="Create client",
     * description="Create new client",
     * operationId="createClient",
     * tags={"clients"},
     * security={ {"sanctum": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Send data to create a new client",
     *    @OA\JsonContent(
     *       @OA\Property(property="user", type="object", ref="#/components/schemas/ClientCreateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="task", type="object", ref="#/components/schemas/ClientResource"),
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
     *      description="Error when creating client",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when creating client")
     *          )
     *      )
     * )
     */
    public function store(ClientCreateRequest $request)
    {
        try {
            $new_client = Client::create($request->validated());
            if($request->password != null){
                $new_client->update(['regist' => true]);
            }
            return response([new ClientResource($new_client)], 201);
        }catch (\Exception $e) {
             return response([
                'Message'=>'Error when creating client. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

    /**
     * @OA\Get(
     * path="/api/clients/{id}",
     * summary="Get client by id",
     * description="Get client by id",
     * operationId="getClient",
     * tags={"clients"},
     * security={ {"sanctum": {}}},
     * @OA\Parameter(
     *    description="ID of client",
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
     *        @OA\Property(property="client", type="object", ref="#/components/schemas/ClientResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="Client is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Client is not found")
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
            $client = Client::find($id);
            if($client != null){
                return response([new ClientResource($client)], 200);
            }
            return responce(['Message'=>'Can\'t find client by id'], 400);
        }catch (\Exception $e) {
            return response([
                'Message'=>'Error when finding client. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

   /**
     * @OA\Patch(
     * path="/api/clients/{id}",
     * summary="Update client",
     * description="Update client",
     * operationId="updateClient",
     * tags={"clients"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of client",
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
     *    description="Send data to update a client",
     *    @OA\JsonContent(
     *       @OA\Property(property="client", type="object", ref="#/components/schemas/ClientUpdateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="client", type="object", ref="#/components/schemas/ClientResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="Client is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Client is not found")
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
     *      description="Error when updating client",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when updating client")
     *          )
     *      )
     * )
     */
    public function update(ClientUpdateRequest $request, string $id)
    {
        try{
            $client = Client::find($id);
            if($client == null){
                return response(['Message'=>'Can\'t find a client with this id'], 400);
            }
            $client->update($request->validated());
            if($request->password != null){
                $client->update(['regist' => true]);
            }
            return response([new ClientResource($client)], 201);
        } catch(\Exception $e){
           return response([
               'Message'=>'Error when updating client. Please, try again',
               'Error' => $e
           ], 500);
        }
    }

    /**
     * @OA\Delete(
     * path="/api/clients/{id}",
     * summary="Delete client by id",
     * description="Delete client by id",
     * operationId="deleteClient",
     * tags={"clients"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of client",
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
     *        @OA\Property(property="client", type="object", ref="#/components/schemas/ClientResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="Client is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Client is not found")
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
        $client = Client::find($id);
        if($client == null){
            return response(['Message'=>'Can\'t find a client with this id'], 400);
        }
        $client->delete();
        return response([new ClientResource($client)], 201);
    }
}
