<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 * @OA\Schema(
 * required={"status", "working_shirt_id", "lead_id", "price", "rating", "date_start"},
 * @OA\Xml(name="OrderCreateRequest"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="status", type="string", example="Выполняется"),
 * @OA\Property(property="working_shirt_id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="lead_id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="price", type="biginteger", example="1200"),
 * @OA\Property(property="rating", type="double",example="4.8"), 
 * @OA\Property(property="date_start", type="string", readOnly="true", format="date", example="2019-02-25"),
 * @OA\Property(property="date_end", type="string", readOnly="true", format="date", example="2019-02-25"),
 * )
 *
 * Class OrderCreateRequest
 *
 */
class OrderCreateRequest extends FormRequest
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
            'status' => 'required|string',
            'working_shirt_id' => 'required|integer',
            'lead_id' => 'required|integer',
            'price' => 'required|biginteger',
            'rating' => 'required|double',
            'date_start' => 'required|date',
            'date_end' => 'nullable|date'
        ];
    }
}
