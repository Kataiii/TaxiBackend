<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;

class OrderController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/order",
     *     summary="Get list of order",
     *     tags={"order"},
     *     security={ {"sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/definitions/OrderResource")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="order isn't found",
     *     )
     * )
     */
    public function index()
    {
        if(count(Order::all()) == 0){
            return response(['Message'=>'Can\'t find order'], 400);
        }
        return OrderResource::collection(Order::all());
    }

    /**
     * @OA\Post(
     * path="/api/order/{id}",
     * summary="Create order",
     * description="Create new order",
     * operationId="createorder",
     * tags={"order"},
     * security={ {"sanctum": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Send data to create a new order",
     *    @OA\JsonContent(
     *       @OA\Property(property="user", type="object", ref="#/components/schemas/OrderCreateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="task", type="object", ref="#/components/schemas/OrderResource"),
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
     *       @OA\Property(property="message", type="string", example="Error when creating order")
     *          )
     *      )
     * )
     */
    public function store(OrderCreateRequest $request)
    {
        try {
            $new_order = Order::create($request->validated());
            return response([new OrderResource($new_order)], 201);
        }catch (\Exception $e) {
             return response([
                'Message'=>'Error when creating order. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

    /**
     * @OA\Get(
     * path="/api/order/{id}",
     * summary="Get order by id",
     * description="Get order by id",
     * operationId="getorder",
     * tags={"order"},
     * security={ {"sanctum": {}}},
     * @OA\Parameter(
     *    description="ID of order class",
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
     *        @OA\Property(property="order", type="object", ref="#/components/schemas/OrderResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="order is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="order is not found")
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
            $order = Order::find($id);
            if($order != null){
                return response([new OrderResource($order)], 200);
            }
            return response(['Message'=>'Can\'t find order by id'], 400);
        }catch (\Exception $e) {
            return response([
                'Message'=>'Error when finding order. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

    /**
     * @OA\Patch(
     * path="/api/order/{id}",
     * summary="Update order",
     * description="Update order",
     * operationId="updateorder",
     * tags={"order"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of order",
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
     *    description="Send data to update a order",
     *    @OA\JsonContent(
     *       @OA\Property(property="order", type="object", ref="#/components/schemas/OrderUpdateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="order", type="object", ref="#/components/schemas/OrderResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="order is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="order is not found")
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
     *      description="Error when updating order",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when updating order")
     *          )
     *      )
     * )
     */
    public function update(OrderUpdateRequest $request, string $id)
    {
        try{
            $order = Order::find($id);
            if($order == null){
                return response(['Message'=>'Can\'t find a order with this id'], 400);
            }
            $order->update($request->validated());
            return response([new OrderResource($order)], 201);
        } catch(\Exception $e){
           return response([
               'Message'=>'Error when updating order. Please, try again',
               'Error' => $e
           ], 500);
        }
    }

    /**
     * @OA\Delete(
     * path="/api/order/{id}",
     * summary="Delete order by id",
     * description="Delete order by id",
     * operationId="deleteorder",
     * tags={"order"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of order",
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
     *        @OA\Property(property="order", type="object", ref="#/components/schemas/OrderResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="order is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="order class is not found")
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
        $order = Order::find($id);
        if($order == null){
            return response(['Message'=>'Can\'t find a order with this id'], 400);
        }
        $order->delete();
        return response([new OrderResource($order)], 201);
    }
}
