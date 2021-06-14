<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourites extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'animal_id'
    ];

    /**
     * Get the user of the favrourite.
    */
    public function get_favourites($id_user)
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
