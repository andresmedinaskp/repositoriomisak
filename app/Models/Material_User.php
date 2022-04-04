<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material_User extends Model
{
    use HasFactory;
    protected $fillable = [
        'manejo_users',
        'detalle_material',
        'date_download',
        'material_id',
        'users_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
