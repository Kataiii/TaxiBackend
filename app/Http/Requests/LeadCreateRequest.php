<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 * @OA\Schema(
 * required={"client_id", "address_from", "address_to"},
 * @OA\Xml(name="LeadCreateRequest"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="address_from", type="string", example="г. Саратов, Политехническая, 17"),
 * @OA\Property(property="address_to", type="string",example="г. Саратов, Политехническая, 18"), 
 * @OA\Property(property="comment", type="text",example="dasadsadsasdasdasdas"),
 * @OA\Property(property="client_id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="car_class_id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="status", type="string", example="Ожидание"),
 * )
 *
 * Class LeadCreateRequest
 *
 */
class LeadCreateRequest extends FormRequest
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
                'client_id' => 'required|integer',
                'address_from' => 'required|string',
                'address_to' => 'required|string',
                'car_class_id' => 'nullable|integer',
                'comment' => 'nullable|string',
                'status' => 'nullable|string'
            ];
    }
}
