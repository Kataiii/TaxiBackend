<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="CompanyResource"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="name", type="string", example="OOO Авто"),
 * @OA\Property(property="representing_person_secondname", type="string", maxLength=32, example="Иванов"),
 * @OA\Property(property="representing_person_firstname", type="string", maxLength=32, example="Иван"),
 * @OA\Property(property="patronymic", type="string", maxLength=32, example="Иванович"), 
 * @OA\Property(property="phone_number", type="string", readOnly="false", description="User unique phone number", example="+79603639696"), 
 * @OA\Property(property="email", type="string", readOnly="false", format="email", description="User unique email address", example="user@gmail.com"), 
 * )
 *
 * Class CompanyResource
 *
 */
class CompanyResource extends JsonResource
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
            'representing_person_secondname' => $this->representing_person_secondname,
            'representing_person_firstname' => $this->representing_person_firstname,
            'patronymic' => $this->patronymic,
            'phone_number' => $this->phone_number,
            'email' => $this->email
        ];
    }
}
