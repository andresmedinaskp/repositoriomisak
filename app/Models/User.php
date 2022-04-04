<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'full_name',
        'document_type',
        'document_number',
        'certificate_misak',
        'email',
        'password'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'remember_token'
    ];


    // relacion de uno a muchos 
    public function rol(){
        return $this->BelongsTo('App\Rol','user_id','id');
    }
    //relacion de muchos a muchos
    public function materials(){
        return $this->belongsToMany('App\Models\Material');
    }
}
