<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ClientResource;
use App\Models\Client;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="LeadResource"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="address_from", type="string", example="г. Саратов, Политехническая, 17"),
 * @OA\Property(property="address_to", type="string",example="г. Саратов, Политехническая, 18"),
 * @OA\Property(property="comment", type="text",example="dasadsadsasdasdasdas"),
 * @OA\Property(property="client", type="#/definitions/ClientResource"),
 * @OA\Property(property="car_class_id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="status", type="string", example="Ожидание"),
 * )
 *
 * Class LeadResource
 *
 */
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
            'client' => new ClientResource(Client::find($this->client_id)),
            'address_from' => $this->address_from,
            'address_to' => $this->address_to,
            'comment' => $this->comment,
            'car_class_id' => $this->car_class_id,
            'status' => $this->status
        ];
    }
}
