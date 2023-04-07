<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Http\Resources\ClientResource;

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
