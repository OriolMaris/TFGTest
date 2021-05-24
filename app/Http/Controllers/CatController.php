<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\Animal;

use Illuminate\Http\Request;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Cat::all();
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
        $cat = new Cat;


        $animal->name = $request->name;
        $animal->age = $request->age;
        $animal->sexe = $request->sexe;
        $animal->species = 'felina';
        $animal->save();
        
        $cat->animal_id = $animal->id;
        $cat->name = $request->name;
        $cat->age = $request->age;
        $cat->sexe = $request->sexe;
        $cat->species = 'felina';
        $return = $cat->save();

        error_log($animal);
        return ($cat);

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
        $animal = Cat::find($id);
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
        Cat::destroy($id);
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
        return Cat::where('name', 'like', '%'.$race.'%')->get();
    }
}