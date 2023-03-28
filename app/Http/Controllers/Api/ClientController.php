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
    
    public function index()
    {
        if(count(Client::all()) == 0){
            return response(['Message'=>'Can\'t find clients'], 400);
        }
        return ClientResource::collection(Client::all());
    }

   
    public function store(ClientCreateRequest $request)
    {
        try {
            $new_client = Client::create($request->validated());
            return response([new ClientResource($new_client)], 201);
        }catch (\Exception $e) {
             return response([
                'Message'=>'Error when creating client. Please, try again',
                'Error' => $e
            ], 500);
        }
    }

    
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
