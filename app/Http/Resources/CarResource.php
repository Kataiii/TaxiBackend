<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 * @OA\Schema(
 * required={"car_number", "car_mark", "car_class_id",  "company_id"},
 * @OA\Xml(name="CarResource"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="car_number", type="string", example="е734са164"),
 * @OA\Property(property="car_mark", type="string",example="skoda octavia"),
 * @OA\Property(property="car_class_id", type="integer", readOnly="true", example="1"),  
 * @OA\Property(property="company_id", type="integer", readOnly="true", example="1"), 
 * )
 *
 * Class CarResource
 *
 */
class CarResource extends JsonResource
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
            'car_number' => $this->car_number,
            'car_mark' => $this->car_mark,
            'car_class_id' => $this->car_class_id,
            'company_id' => $this->company_id
        ];
    }
}
