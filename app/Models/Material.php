<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'isbn',
        'year',
        'num_pages',
        'priority',
        'pdf',
        'img',
        'type_material_id',
        'editorial_id',
        'area_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    //relacion de muchos a muchos
    public function authors(){
        return $this->belongsToMany('App\Models\Author');
    }

    //relacion de muchos a muchos
    public function educational_levels(){
        return $this->belongsToMany('App\Models\Educational_level');
    }
     //relacion de muchos a muchos
     public function user(){
        return $this->belongsToMany('App\Models\User');
    }

    //Relacion de muchos a uno 
    public function Type_materila(){
        return $this->hasMany('App\Type_Material','type_material_id','id');
    }
    //Relacion de muchos a uno 
    public function editorial(){
        return $this->hasMany('App\Editorial','editorial_id','id');
    }
    //Relacion de muchos a uno 
    public function area(){
        return $this->hasMany('App\Area','area_id','id');
    }
}
