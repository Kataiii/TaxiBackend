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
     * Display a listing of the resource.
     */
    public function index()
    {
        if(count(Lead::all()) == 0){
            return response(['Message'=>'Can\'t find leads'], 400);
        }
        return LeadResource::collection(Lead::all());
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
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
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lead = Client::find($id);
        if($lead == null){
            return response(['Message'=>'Can\'t find a lead with this id'], 400);
        }
        $lead->delete();
        return response([new LeadResource($lead)], 201);
    }
}
