<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Animal;

class Dog extends Animal
{
    use HasFactory;

    protected $fillable = [
        'animal_id',
        'cabell',
        'cabell_ty pe',
        '',
        '',
    ];
}
