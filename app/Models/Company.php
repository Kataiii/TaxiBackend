<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * required={"name", "inn", "phone_number", "email", "representing_person_secondname", "representing_person_firstname"},
 * @OA\Xml(name="Company"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="name", type="string", example="OOO Авто"),
 * @OA\Property(property="representing_person_secondname", type="string", maxLength=32, example="Иванов"),
 * @OA\Property(property="representing_person_firstname", type="string", maxLength=32, example="Иван"),
 * @OA\Property(property="patronymic", type="string", maxLength=32, example="Иванович"), 
 * @OA\Property(property="phone_number", type="string", readOnly="false", description="User unique phone number", example="+79603639696"), 
 * @OA\Property(property="email", type="string", readOnly="false", format="email", description="User unique email address", example="user@gmail.com"), 
 * @OA\Property(property="created_at", type="string", readOnly="true", format="date", description="Datetime marker of create status", example="2019-02-25"),
 * @OA\Property(property="updated_at", type="string", readOnly="true", format="date", description="Datetime marker of update status", example="2019-02-25")
 * )
 *
 * Class Company
 *
 */
class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'inn',
        'phone_number',
        'email',
        'representing_person_secondname',
        'representing_person_firstname',
        'representing_person_patronomec'
    ];
}
