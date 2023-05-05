<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 * @OA\Schema(
 * required={"car_number", "car_mark", "car_class_id",  "company_id"},
 * @OA\Xml(name="CarCreateRequest"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="car_number", type="string", example="е734са164"),
 * @OA\Property(property="car_mark", type="string",example="skoda octavia"),
 * @OA\Property(property="car_class_id", type="integer", readOnly="true", example="1"),  
 * @OA\Property(property="company_id", type="integer", readOnly="true", example="1"), 
 * )
 *
 * Class CarCreateRequest
 *
 */
class CarCreateRequest extends FormRequest
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
            'car_number'  => 'required|string',
            'car_mark' => 'required|string',
            'car_class_id' => 'required|integer',
            'company_id' => 'required|integer'
        ];
    }
}
