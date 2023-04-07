<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ClientResource;
use App\Models\Client;

class LeadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            //'relationships' => [
            'client' => new ClientResource(Client::find($this->client_id)),
            //],
            'address_from' => $this->address_from,
            'address_to' => $this->address_to
        ];
    }
}
