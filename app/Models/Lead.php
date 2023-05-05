<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Http\Resources\ClientResource;

/**
 *
 * @OA\Schema(
 * required={"client_id", "address_from", "address_to"},
 * @OA\Xml(name="Lead"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="address_from", type="string", example="г. Саратов, Политехническая, 17"),
 * @OA\Property(property="address_to", type="string",example="г. Саратов, Политехническая, 18"), 
 * @OA\Property(property="driving_licence_number", type="string",example="566655"),
 * @OA\Property(property="comment", type="text",example="dasadsadsasdasdasdas"),
 * @OA\Property(property="client_id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="car_class_id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="status", type="string", example="Ожидание"),
 * @OA\Property(property="created_at", type="string", readOnly="true", format="date", description="Datetime marker of create status", example="2019-02-25"),
 * @OA\Property(property="updated_at", type="string", readOnly="true", format="date", description="Datetime marker of update status", example="2019-02-25")
 * )
 *
 * Class Lead
 *
 */
class Lead extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_id',
        'address_from',
        'address_to'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(ClientResource::class);
    }
}
