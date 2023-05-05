<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * required={"name", "driver_id", "car_id", "driver_location", "date_start"},
 * @OA\Xml(name="WorkingShift"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="driver_id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="car_id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="driver_location", type="string", example="Ленинский"),
 * @OA\Property(property="date_start", type="string", readOnly="true", format="date", example="2019-02-25"),
 * @OA\Property(property="date_end", type="string", readOnly="true", format="date", example="2019-02-25")
 * @OA\Property(property="created_at", type="string", readOnly="true", format="date", description="Datetime marker of create status", example="2019-02-25"),
 * @OA\Property(property="updated_at", type="string", readOnly="true", format="date", description="Datetime marker of update status", example="2019-02-25")
 * )
 *
 * Class WorkingShift
 *
 */
class WorkingShift extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'driver_id',
        'car_id',
        'driver_location',
        'date_start'
    ];
}
