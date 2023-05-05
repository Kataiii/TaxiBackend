<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 * @OA\Schema(
 * required={"name", "priority"},
 * @OA\Xml(name="CarClassUpdateRequest"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="name", type="string", example="комфорт"),
 * @OA\Property(property="description", type="text",example="sdfsfsaffafadafsfasd"), 
 * @OA\Property(property="priority", type="integer",example="2"), 
 * )
 *
 * Class CarClassUpdateRequest
 *
 */
class CarClassUpdateRequest extends FormRequest
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
            'name'  => 'nullable|string',
            'description' => 'nullable|string',
            'priority' => 'nullable|integer'
        ];
    }
}
