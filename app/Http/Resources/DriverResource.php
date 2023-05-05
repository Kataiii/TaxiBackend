<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="DriverResource"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="secondname", type="string", maxLength=32, example="Иванов"),
 * @OA\Property(property="firstname", type="string", maxLength=32, example="Иван"),
 * @OA\Property(property="patronymic", type="string", maxLength=32, example="Иванович"), 
 * @OA\Property(property="date_hired",type="string", readOnly="true", format="date",example="2019-02-25"), 
 * @OA\Property(property="date_fired",type="string", readOnly="true", format="date",example="2019-02-25"), 
 * @OA\Property(property="rating", type="double", readOnly="true", example="4.8"),
 * @OA\Property(property="driving_licence_id", type="integer", readOnly="true", example="1"),
 * )
 *
 * Class DriverResource
 *
 */
class DriverResource extends JsonResource
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
            'secondname' => $this->secondname,
            'firstname' => $this->firstname,
            'patronymic' => $this->patronymic,
            'date_hired' => $this->date_hired,
            'date_fired' => $this->date_fired,
            'rating' => $this->rating,
            'driving_licence_id' => $this->driving_licence_id
        ];
    }
}
