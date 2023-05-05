<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="DrivingLicenceResource"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="category", type="string", example="a"),
 * @OA\Property(property="driving_licence_series", type="string",example="466545646"),
 * @OA\Property(property="driving_licence_number", type="string",example="566655"),
 * @OA\Property(property="driving_getting",type="string", readOnly="true", format="date",example="2019-02-25"), 
 * @OA\Property(property="driving_deprivation",type="string", readOnly="true", format="date",example="2019-02-25"), 
 * @OA\Property(property="driving_licence_id", type="integer", readOnly="true", example="1"),
 * )
 *
 * Class DrivingLicenceResource
 *
 */
class DrivingLicenceResource extends JsonResource
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
            'category' => $this->category,
            'driving_licence_series' => $this->driving_licence_series,
            'driving_licence_number' => $this->driving_licence_number,
            'driving_getting' => $this->driving_getting,
            'driving_deprivation' => $this->driving_deprivation,
            'driving_licence_id' => $this->driving_licence_id
        ];
    }
}
