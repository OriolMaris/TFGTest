<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'sexe',
        'race',
        'species',
        'owner_id',
        'caracter',
        'hair_type',
        'castrat',
        'ciutat',
        'size',
        'description',
        'microxip',
        'vacunated',
        'esterizated',
        'photo_name'
    ];

}
