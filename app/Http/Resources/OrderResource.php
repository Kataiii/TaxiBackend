<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="OrderResource"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="status", type="string", example="Выполняется"),
 * @OA\Property(property="working_shirt_id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="lead_id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="price", type="biginteger", example="1200"),
 * @OA\Property(property="rating", type="double",example="4.8"), 
 * @OA\Property(property="date_start", type="string", readOnly="true", format="date", example="2019-02-25"),
 * @OA\Property(property="date_end", type="string", readOnly="true", format="date", example="2019-02-25"),
 * )
 *
 * Class OrderResource
 *
 */
class OrderResource extends JsonResource
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
            'status' => $this->status,
            'working_shirt_id' => $this->working_shirt_id,
            'lead_id' => $this->lead_id,
            'price' => $this->price,
            'rating' => $this->rating,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end
        ];
    }
}
