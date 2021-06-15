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
    public function store($user_id, $animal_id)
    {

        $favourites = new Favourites();
        $favourites->user_id = $user_id;
        $favourites->animal_id = $animal_id;
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

    public function get_favourites($user_id) {
        $animals = null;
        error_log($user_id);

        foreach (Favourites::where('user_id', 'like', $user_id)->get() as $favourite) {
            error_log($favourite);
            $animal = Animal::where('id', $favourite->animal_id)->first();
            
            
            $animals [] = [
                'id' => $animal->id,
                'name' => $animal->name,
                'age' => $animal->age,
                'sexe' => $animal->sexe,
                'race' => $animal->race,
                'species' => $animal->species,
                'owner_id' => $animal->owner_id,
                'caracter' => $animal->caracter,
                'hair_type' => $animal->hair_type,
                'castrat' => $animal->castrat,
                'ciutat' => $animal->ciutat,
                'size' => $animal->size,
                'description' => $animal->description,
                'microxip' => $animal->microxip,
                'vacunated' => $animal->vacunated,
                'esterizated' => $animal->esterizated,
                'photo_name' => $animal->photo_name,
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


    public function delete($user_id, $animal_id)
    {

        $favourites = Favourites::where('user_id', 'like', $user_id)->where('animal_id', 'like', $animal_id)->delete();
        return $favourites;
    }

    public function isFavourite($user_id, $animal_id)
    {
        $favourites = Favourites::where('user_id', 'like', $user_id)->where('animal_id', 'like', $animal_id)->get()->first();
        if ($favourites !== null){
            return response()->json([
                'message' => true
            ], 200);
        }
        return response()->json([
            'message' => false
        ], 400);
    }
}
