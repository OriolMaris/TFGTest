<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Animal::all();
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
            'name' => 'required',
            'age' => 'required',
            'sexe' => 'required',
            'owner_id' => 'required',
        ]);
        
        $animal = new Animal();
        $animal->name = $request->name;
        $animal->age = $request->age;
        $animal->sexe = $request->sexe;
        $animal->race = $request->race;
        $animal->species = $request->species;
        $animal->owner_id = $request->owner_id;

        $request->photo_name->store('public/uploads');
        $file_name = $request->photo_name->hashName();

        $animal->photo_name = $file_name;
        $animal->save(); 

        return $animal;
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
        $animal = Animal::find($id);
        return $animal;
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
        $animal = Animal::find($id);
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
        Animal::destroy($id);
    }


    /**
     * Search of a race.
     *
     * @param  str  $race
     * @return \Illuminate\Http\Response
     */
    public function cats()
    {
        //
        return Animal::where('species', 'like', 'feline')->get();
    }

    public function dogs()
    {
        //
        return Animal::where('name', 'like', 'cannine')->get();
    }

    public function owner($owner_id)
    {
        //
        return Animal::where('owner_id', 'like', '%'.$owner_id.'%')->get();
    }


}
