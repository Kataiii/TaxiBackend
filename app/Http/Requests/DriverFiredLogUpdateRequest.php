<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="DriverFiredLogUpdateRequest"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="date_hired",type="string", readOnly="true", format="date",example="2019-02-25"), 
 * @OA\Property(property="date_fired",type="string", readOnly="true", format="date",example="2019-02-25"), 
 * @OA\Property(property="driver_id", type="integer", readOnly="true", example="1"),
 * )
 *
 * Class DriverFiredLogUpdateRequest
 *
 */
class DriverFiredLogUpdateRequest extends FormRequest
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
            'date_hired' => 'nullable|date',
            'date_fired' => 'nullable|date',
            'driver_id' => 'nullable|integer'
        ];
    }
}
