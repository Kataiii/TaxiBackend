<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * required={"name", "priority"},
 * @OA\Xml(name="CarClass"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="name", type="string", example="комфорт"),
 * @OA\Property(property="description", type="text",example="sdfsfsaffafadafsfasd"), 
 * @OA\Property(property="priority", type="integer",example="2"), 
 * @OA\Property(property="created_at", type="string", readOnly="true", format="date", description="Datetime marker of create status", example="2019-02-25"),
 * @OA\Property(property="updated_at", type="string", readOnly="true", format="date", description="Datetime marker of update status", example="2019-02-25")
 * )
 *
 * Class CarClass
 *
 */
class CarClass extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'priority'
    ];
}
