<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 *
 * @OA\Schema(
 * required={"car_id", "end_date"},
 * @OA\Xml(name="CarReparingLogResource"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="car_id", type="integer", example="1"),
 * @OA\Property(property="end_date",type="string", readOnly="true", format="date",example="2019-02-25"), 
 * )
 *
 * Class CarReparingLogResource
 *
 */
class CarReparingLogResource extends JsonResource
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
            'car_id' => $this->car_id,
            'end_date' => $this->end_date
        ];
    }
}
