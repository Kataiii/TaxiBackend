<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * required={"status", "working_shirt_id", "lead_id", "price", "rating", "date_start"},
 * @OA\Xml(name="Order"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="status", type="string", example="Выполняется"),
 * @OA\Property(property="working_shirt_id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="lead_id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="price", type="biginteger", example="1200"),
 * @OA\Property(property="rating", type="double",example="4.8"), 
 * @OA\Property(property="date_start", type="string", readOnly="true", format="date", example="2019-02-25"),
 * @OA\Property(property="date_end", type="string", readOnly="true", format="date", example="2019-02-25")
 * @OA\Property(property="created_at", type="string", readOnly="true", format="date", description="Datetime marker of create status", example="2019-02-25"),
 * @OA\Property(property="updated_at", type="string", readOnly="true", format="date", description="Datetime marker of update status", example="2019-02-25")
 * )
 *
 * Class Order
 *
 */
class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'working_shirt_id',
        'lead_id',
        'price',
        'rating',
        'date_start'
    ];
}
