<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Get list of users",
     *     tags={"users"},
     *     security={ {"sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/definitions/UserResource")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Users isn't found",
     *     )
     * )
     */
    public function index()
    {
        if(count(User::all()) == 0){
            return response(['Message'=>'Can\'t find users'], 400);
        }
        return UserResource::collection(User::all());
    }

    /**
     * @OA\Post(
     * path="/api/users/{id}",
     * summary="Create user",
     * description="Create new user",
     * operationId="createUser",
     * tags={"users"},
     * security={ {"sanctum": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Send data to create a new user",
     *    @OA\JsonContent(
     *       @OA\Property(property="user", type="object", ref="#/components/schemas/UserCreateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="task", type="object", ref="#/components/schemas/UserResource"),
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
     *      description="Error when creating user",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when creating user")
     *          )
     *      )
     * )
     */
    public function store(UserCreateRequest $request)
    {
        try {
            $new_user = User::create($request->validated());
            return response([new UserResource($new_user)], 201);
        }catch (\Exception $e) {
            return response([
                'Message'=>'Error when creating user. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

    
    /**
     * @OA\Get(
     * path="/api/users/{id}",
     * summary="Get user by id",
     * description="Get user by id",
     * operationId="getUser",
     * tags={"users"},
     * security={ {"sanctum": {}}},
     * @OA\Parameter(
     *    description="ID of user",
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
     *        @OA\Property(property="user", type="object", ref="#/components/schemas/UserResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="User is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="User is not found")
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
     * ),
     * @OA\Response(
     *      response="500",
     *      description="Error server",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when finding user. Please, try again")
     *        )
     *     )
     * )
     */
    public function show(string $id)
    {
        try {
            $user = User::find($id);
            if($user != null){
                return response([new UserResource($user)], 200);
            }
            return responce(['Message'=>'Can\'t find user by id'], 400);
        }catch (\Exception $e) {
            return response([
                'Message'=>'Error when finding user. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

    /**
     * @OA\Patch(
     * path="/api/users/{id}",
     * summary="Update user",
     * description="Update user",
     * operationId="updateUser",
     * tags={"users"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of user",
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
     *    description="Send data to update a user",
     *    @OA\JsonContent(
     *       @OA\Property(property="user", type="object", ref="#/components/schemas/UserUpdateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="user", type="object", ref="#/components/schemas/UserResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="User is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Task is not found")
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
     *      description="Error when updating user",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when updating user")
     *          )
     *      )
     * )
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        try{
            $user = User::find($id);
            if($user == null){
                return response(['Message'=>'Can\'t find a user with this id'], 400);
            }
            $user->update($request->validated());
            return response([new UserResource($user)], 201);
        } catch(\Exception $e){
            return response([
                'Message'=>'Error when updating user. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     * path="/api/users/{id}",
     * summary="Delete user by id",
     * description="Delete user by id",
     * operationId="deleteUser",
     * tags={"users"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of user",
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
     *        @OA\Property(property="user", type="object", ref="#/components/schemas/UserResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="User is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="User is not found")
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
        $user = User::find($id);
        if($user == null){
            return response(['Message'=>'Can\'t find a user with this id'], 404);
        }
        $user->delete();
        return response([new UserResource($user)], 201);
    }
}
