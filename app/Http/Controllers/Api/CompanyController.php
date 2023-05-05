<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;

class CompanyController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/company",
     *     summary="Get list of company",
     *     tags={"company"},
     *     security={ {"sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/definitions/CompanyResource")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Company isn't found",
     *     )
     * )
     */
    public function index()
    {
        if(count(Company::all()) == 0){
            return response(['Message'=>'Can\'t find company'], 400);
        }
        return CompanyResource::collection(Company::all());
    }

    /**
     * @OA\Post(
     * path="/api/company/{id}",
     * summary="Create company",
     * description="Create new company",
     * operationId="createCompany",
     * tags={"company"},
     * security={ {"sanctum": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Send data to create a new company",
     *    @OA\JsonContent(
     *       @OA\Property(property="user", type="object", ref="#/components/schemas/CompanyCreateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="task", type="object", ref="#/components/schemas/CompanyResource"),
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
     *      description="Error when creating Company",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when creating Company")
     *          )
     *      )
     * )
     */
    public function store(CompanyCreateRequest $request)
    {
        try {
            $new_company = Company::create($request->validated());
            return response([new CompanyResource($c)], 201);
        }catch (\Exception $e) {
             return response([
                'Message'=>'Error when creating company. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

        /**
     * @OA\Get(
     * path="/api/company/{id}",
     * summary="Get company by id",
     * description="Get company by id",
     * operationId="getCompany",
     * tags={"company"},
     * security={ {"sanctum": {}}},
     * @OA\Parameter(
     *    description="ID of company class",
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
     *        @OA\Property(property="Company", type="object", ref="#/components/schemas/CompanyResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="Company is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Company is not found")
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
            $company = Company::find($id);
            if($company != null){
                return response([new CompanyResource($company)], 200);
            }
            return response(['Message'=>'Can\'t find company by id'], 400);
        }catch (\Exception $e) {
            return response([
                'Message'=>'Error when finding company. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

       /**
     * @OA\Patch(
     * path="/api/company/{id}",
     * summary="Update company",
     * description="Update company",
     * operationId="updateCompany",
     * tags={"company"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of company",
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
     *    description="Send data to update a company",
     *    @OA\JsonContent(
     *       @OA\Property(property="Company", type="object", ref="#/components/schemas/CompanyUpdateRequest"),
     *    ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="Company", type="object", ref="#/components/schemas/CompanyResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="400",
     *      description="Company is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Company is not found")
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
     *      description="Error when updating company",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error when updating company")
     *          )
     *      )
     * )
     */
    public function update(CompanyUpdateRequest $request, string $id)
    {
        try{
            $company = Company::find($id);
            if($company == null){
                return response(['Message'=>'Can\'t find a company with this id'], 400);
            }
            $company->update($request->validated());
            return response([new CompanyResource($company)], 201);
        } catch(\Exception $e){
           return response([
               'Message'=>'Error when updating Company. Please, try again',
               'Error' => $e
           ], 500);
        }
    }

        /**
     * @OA\Delete(
     * path="/api/company/{id}",
     * summary="Delete company by id",
     * description="Delete company by id",
     * operationId="deleteCompany",
     * tags={"company"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *    description="ID of Company",
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
     *        @OA\Property(property="Company", type="object", ref="#/components/schemas/CompanyResource"),
     *     )
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="Company is not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Company class is not found")
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
        $company = Company::find($id);
        if($company == null){
            return response(['Message'=>'Can\'t find a company with this id'], 400);
        }
        $company->delete();
        return response([new CompanyResource($company)], 201);
    }
}
