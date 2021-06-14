<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Favourites;
use App\Models\Users;
use Illuminate\Http\Request;

class FavouritesController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'user_id' => 'required',
            'animal_id' => 'required'
        ]);
        
        $favourites = new Favourites();
        $favourites->user_id = $request->user_id;
        $favourites->animal_id = $request->animal_id;
        $favourites->save(); 

        return $favourites;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Animal::destroy($id);
    }

    public function get_favourites($id_user) {
        $animals = null;
        foreach (Favourites::where('user_id', $id_user) as $favourite) {
            $animal = Animal::where('id', $favourite->animal_id)->first();
            
            $animals [] = [
                'id' => $animal->id,
                'name' => $animal->name;
                'age' => $animal->age;
                'sexe' => $animal->sexe;
                'race' => $animal->race;
                'species' => $animal->species;
                'owner_id' => $animal->owner_id;
                'caracter' => $animal->caracter;
                'hair_type' => $animal->hair_type; 
                'castrat' => $animal->castrat;
                'ciutat' => $animal->ciutat;
                'size' => $animal->size;
                'description' => $animal->description;
                'microxip' => $animal->microxip;
                'vacunated' => $animal->vacunated;
                'esterizated' => $animal->esterizated;
            ];
        }
        if ($animals !== null) {
            $data = ['favourites' => $animals];
            return $data;
        }
        return response()->json([
            'missage' => 'Aquest usuari no existeix o no té cap seguidor.'
        ], 404);
    }


}
