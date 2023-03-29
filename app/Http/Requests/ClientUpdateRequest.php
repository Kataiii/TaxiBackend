<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


/**
 *
 * @OA\Schema(
 * @OA\Xml(name="ClientUpdateRequest"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="secondname", type="string", maxLength=32, example="Иванов"),
 * @OA\Property(property="firstname", type="string", maxLength=32, example="Иван"),
 * @OA\Property(property="patronymic", type="string", maxLength=32, example="Иванович"), 
 * @OA\Property(property="phone_number", type="string", readOnly="false", description="User unique phone number", example="+79603639696"), 
 * @OA\Property(property="password", type="string", readOnly="false", minLength=6, example="qwerty"),   
 * @OA\Property(property="address", type="string", example="Саратов"),  
 * @OA\Property(property="email", type="string", readOnly="false", format="email", description="User unique email address", example="user@gmail.com")
 * )
 *
 * Class ClientUpdateRequest
 *
 */
class ClientUpdateRequest extends FormRequest
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
            'firstname' => 'nullable|string|max:255',
            'secondname' => 'nullable|string|max:255',
            'patronymic' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'email' => 'nullable|string',
            'password' => 'nullable|string|min:6|max:255',
            'regist' => 'nullable|string'
        ];
    }
}
