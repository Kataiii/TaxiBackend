<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


/**
 *
 * @OA\Schema(
 * required={"firstname", "secondname", "phone_number",  "email", "password", "departament_id"},
 * @OA\Xml(name="UserCreateRequest"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="secondname", type="string", maxLength=32, example="Иванов"),
 * @OA\Property(property="firstname", type="string", maxLength=32, example="Иван"),
 * @OA\Property(property="patronymic", type="string", maxLength=32, example="Иванович"), 
 * @OA\Property(property="phone_number", type="string", readOnly="false", description="User unique phone number", example="+79603639696"), 
 * @OA\Property(property="password", type="string", readOnly="false", minLength=6, example="qwerty"),   
 * @OA\Property(property="address", type="string", example="Саратов"),  
 * @OA\Property(property="email", type="string", readOnly="false", format="email", description="User unique email address", example="user@gmail.com"),
 * @OA\Property(property="departament_id", type="integer", readOnly="true", example="1"),  
 * @OA\Property(property="date_of_birth", type="string", readOnly="true", format="date", example="1985-02-25")
 * )
 *
 * Class UserCreateRequest
 *
 */
class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|string|max:255',
            'secondname' => 'required|string|max:255',
            'patronymic' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:255',
            'address' => 'nullable|string',
            'email' => 'required|string',
            'password' => 'required|string|min:6|max:255',
            'departament_id' => 'required|integer',
            'date_of_birth' => 'nullable|date'
        ];
    }
}
