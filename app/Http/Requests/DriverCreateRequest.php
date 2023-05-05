<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 * @OA\Schema(
 * required={"firstname", "secondname", "date_hired", "driving_licence_id", "rating"},
 * @OA\Xml(name="DriverCreateRequest"),
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
 * Class DriverCreateRequest
 *
 */
class DriverCreateRequest extends FormRequest
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
            'date_hired' => 'required|date',
            'date_fired' => 'nullable|date',
            'rating' => 'required|double',
            'driving_licence_id' => 'required|integer'
        ];
    }
}
