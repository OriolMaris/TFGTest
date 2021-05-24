<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use App\Models\Animal;

use Illuminate\Http\Request;

class DogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Dog::all();
    }

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
            'animal_id' => 'required',
        ]);
        
        $animal = new Animal;
        $dog = new Dog;


        $animal->name = $request->name;
        $animal->age = $request->age;
        $animal->sexe = $request->sexe;
        $animal->species = 'cannina';
        $animal->save();
        
        $dog->animal_id = $animal->id;
        $dog->name = $request->name;
        $dog->age = $request->age;
        $dog->sexe = $request->sexe;
        $dog->species = 'cannina';
        $return = $dog->save();

        error_log($animal);
        return ($dog);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $animal = Dog::find($id);
        $animal->update($request->all());
        return $animal;
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
        Dog::destroy($id);
    }


    /**
     * Search of a race.
     *
     * @param  str  $race
     * @return \Illuminate\Http\Response
     */
    public function search($race)
    {
        //
        return Dog::where('name', 'like', '%'.$race.'%')->get();
    }
}