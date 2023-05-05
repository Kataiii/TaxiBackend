<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="WorkingShiftResource"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="driver_id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="car_id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="driver_location", type="string", example="Ленинский"),
 * @OA\Property(property="date_start", type="string", readOnly="true", format="date", example="2019-02-25"),
 * @OA\Property(property="date_end", type="string", readOnly="true", format="date", example="2019-02-25"),
 * )
 *
 * Class WorkingShiftResource
 *
 */
class WorkingShiftResource extends JsonResource
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
            'driver_id' => $this->driver_id,
            'car_id' => $this->car_id,
            'driver_location' => $this->driver_location,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end
        ];
    }
}
