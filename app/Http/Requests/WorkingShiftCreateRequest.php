<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 * @OA\Schema(
 * required={"name", "driver_id", "car_id", "driver_location", "date_start"},
 * @OA\Xml(name="WorkingShiftCreateRequest"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="driver_id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="car_id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="driver_location", type="string", example="Ленинский"),
 * @OA\Property(property="date_start", type="string", readOnly="true", format="date", example="2019-02-25"),
 * @OA\Property(property="date_end", type="string", readOnly="true", format="date", example="2019-02-25"),
 * )
 *
 * Class WorkingShiftCreateRequest
 *
 */
class WorkingShiftCreateRequest extends FormRequest
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
            'driver_id' => 'required|integer',
            'car_id' => 'required|integer',
            'driver_location' => 'required|string',
            'date_start' => 'required|date',
            'date_end' => 'nullable|date'
        ];
    }
}
