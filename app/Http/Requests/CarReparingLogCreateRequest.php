<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 * @OA\Schema(
 * required={"car_id", "end_date"},
 * @OA\Xml(name="CarReparingLogCreateRequest"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="car_id", type="integer", example="1"),
 * @OA\Property(property="end_date",type="string", readOnly="true", format="date",example="2019-02-25"), 
 * )
 *
 * Class CarReparingLogCreateRequest
 *
 */
class CarReparingLogCreateRequest extends FormRequest
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
            'car_id'  => 'required|integer',
            'end_date' => 'required|date'
        ];
    }
}
