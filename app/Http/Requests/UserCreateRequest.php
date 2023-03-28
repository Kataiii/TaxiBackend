<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
