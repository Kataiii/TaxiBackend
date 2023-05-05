<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 * @OA\Schema(
 * required={"name", "priority"},
 * @OA\Xml(name="CarClassResource"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="name", type="string", example="комфорт"),
 * @OA\Property(property="description", type="text",example="sdfsfsaffafadafsfasd"), 
 * @OA\Property(property="priority", type="integer",example="2"), 
 * )
 *
 * Class CarClassResource
 *
 */
class CarClassResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'priority' => $this->priority
        ];
    }
}
