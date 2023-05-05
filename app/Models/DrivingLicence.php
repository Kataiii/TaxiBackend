<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * required={"category", "driving_licence_series", "driving_licence_number", "driving_getting", "driving_deprivation"},
 * @OA\Xml(name="DrivingLicence"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="category", type="string", example="a"),
 * @OA\Property(property="driving_licence_series", type="string",example="466545646"),
 * @OA\Property(property="driving_licence_number", type="string",example="566655"),
 * @OA\Property(property="driving_getting",type="string", readOnly="true", format="date",example="2019-02-25"), 
 * @OA\Property(property="driving_deprivation",type="string", readOnly="true", format="date",example="2019-02-25"), 
 * @OA\Property(property="driving_licence_id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="created_at", type="string", readOnly="true", format="date", description="Datetime marker of create status", example="2019-02-25"),
 * @OA\Property(property="updated_at", type="string", readOnly="true", format="date", description="Datetime marker of update status", example="2019-02-25")
 * )
 *
 * Class DrivingLicence
 *
 */
class DrivingLicence extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category',
        'driving_licence_series',
        'driving_licence_number',
        'driving_getting',
        'driving_deprivation'
    ];
}
