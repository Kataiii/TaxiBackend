<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * required={"car_number", "car_mark", "car_class_id",  "company_id"},
 * @OA\Xml(name="Car"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="car_number", type="string", example="е734са164"),
 * @OA\Property(property="car_mark", type="string",example="skoda octavia"),
 * @OA\Property(property="car_class_id", type="integer", readOnly="true", example="1"),  
 * @OA\Property(property="company_id", type="integer", readOnly="true", example="1"), 
 * @OA\Property(property="created_at", type="string", readOnly="true", format="date", description="Datetime marker of create status", example="2019-02-25"),
 * @OA\Property(property="updated_at", type="string", readOnly="true", format="date", description="Datetime marker of update status", example="2019-02-25")
 * )
 *
 * Class Car
 *
 */
class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_number',
        'car_mark',
        'car_class_id',
        'company_id'
    ];
}
