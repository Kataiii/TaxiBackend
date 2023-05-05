<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="DriverFiredLog"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="date_hired",type="string", readOnly="true", format="date",example="2019-02-25"), 
 * @OA\Property(property="date_fired",type="string", readOnly="true", format="date",example="2019-02-25"), 
 * @OA\Property(property="driver_id", type="integer", readOnly="true", example="1"),
 * )
 *
 * Class DriverFiredLog
 *
 */
class DriverFiredLogResource extends JsonResource
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
            'date_hired' => $this->date_hired,
            'date_fired' => $this->date_fired,
            'driver_id' => $this->driver_id
        ];
    }
}
