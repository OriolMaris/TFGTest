<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Animal;

class Cat extends Animal
{
    use HasFactory;

    protected $fillable = [
        'animal_id',
        'race',
    ];
}
