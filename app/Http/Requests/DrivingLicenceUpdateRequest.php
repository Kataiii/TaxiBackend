<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="DrivingLicenceUpdateRequest"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="category", type="string", example="a"),
 * @OA\Property(property="driving_licence_series", type="string",example="466545646"),
 * @OA\Property(property="driving_licence_number", type="string",example="566655"),
 * @OA\Property(property="driving_getting",type="string", readOnly="true", format="date",example="2019-02-25"), 
 * @OA\Property(property="driving_deprivation",type="string", readOnly="true", format="date",example="2019-02-25"), 
 * @OA\Property(property="driving_licence_id", type="integer", readOnly="true", example="1"),
 * )
 *
 * Class DrivingLicenceUpdateRequest
 *
 */
class DrivingLicenceUpdateRequest extends FormRequest
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
            'category' => 'nullable|string',
            'driving_licence_series' => 'nullable|string',
            'driving_licence_number' => 'nullable|string',
            'driving_getting' => 'nullable|date',
            'driving_deprivation' => 'nullable|date',
            'driving_licence_id' => 'nullable|integer'
        ];
    }
}
