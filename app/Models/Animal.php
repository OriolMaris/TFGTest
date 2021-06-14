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
        'race',
        'species',
        'genere',
        'size',
        'castrat',
        'caracter',
        'hair_type',
        'description',
        'microxip',
        'vacunated',
        'owner_id',
        'esterizated',
        'photo_name'
    ];

}
