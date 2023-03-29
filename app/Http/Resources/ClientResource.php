<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 *
 * @OA\Schema(
 * required={"firstname", "secondname", "phone_number",  "email", "password", "departament_id"},
 * @OA\Xml(name="UserResource"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="secondname", type="string", maxLength=32, example="Иванов"),
 * @OA\Property(property="firstname", type="string", maxLength=32, example="Иван"),
 * @OA\Property(property="patronymic", type="string", maxLength=32, example="Иванович"), 
 * @OA\Property(property="phone_number", type="string", readOnly="false", description="User unique phone number", example="+79603639696"),  
 * @OA\Property(property="email", type="string", readOnly="false", format="email", description="User unique email address", example="user@gmail.com"),
 * @OA\Property(property="address", type="string", example="Саратов")
 * )
 *
 * Class UserResource
 *
 */
class ClientResource extends JsonResource
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
            'firstname' => $this->firstname,
            'secondname' => $this->secondname,
            'patronymic' => $this->patronymic,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'address' => $this->address
        ];
    }
}
