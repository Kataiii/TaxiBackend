<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 * @OA\Schema(
 * required={"category", "driving_licence_series", "driving_licence_number", "driving_getting", "driving_deprivation"},
 * @OA\Xml(name="DrivingLicenceCreateRequest"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="category", type="string", example="a"),
 * @OA\Property(property="driving_licence_series", type="string",example="466545646"),
 * @OA\Property(property="driving_licence_number", type="string",example="566655"),
 * @OA\Property(property="driving_getting",type="string", readOnly="true", format="date",example="2019-02-25"), 
 * @OA\Property(property="driving_deprivation",type="string", readOnly="true", format="date",example="2019-02-25"), 
 * @OA\Property(property="driving_licence_id", type="integer", readOnly="true", example="1"),
 * )
 *
 * Class DrivingLicenceCreateRequest
 *
 */
class DrivingLicenceCreateRequest extends FormRequest
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
            'category' => 'required|string',
            'driving_licence_series' => 'required|string',
            'driving_licence_number' => 'required|string',
            'driving_getting' => 'required|date',
            'driving_deprivation' => 'required|date',
            'driving_licence_id' => 'required|integer'
        ];
    }
}
