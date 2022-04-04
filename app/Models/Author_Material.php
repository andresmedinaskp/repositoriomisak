<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author_Material extends Model
{
    protected $fillable =[
        'author_id',
        'material_id'

    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    use HasFactory;
    
}


