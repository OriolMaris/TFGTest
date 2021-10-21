<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use App\Models\Favourites;

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
            'race' => 'required',
            'species' => 'required',
            'owner_id' => 'required',
            'caracter' => 'required',
            'hair_type' => 'required',
            'castrat' => 'required',
            'ciutat' => 'required',
            'size' => 'required',
            'description' => 'required',
            'microxip' => 'required',
            'vacunated' => 'required',
            'esterizated' => 'required',
        ]);
        
        $animal = new Animal();
        $animal->name = $request->name;
        $animal->age = $request->age;
        $animal->sexe = $request->sexe;
        $animal->race = $request->race;
        $animal->species = $request->species;
        $animal->owner_id = $request->owner_id;
        $animal->caracter = $request->caracter;
        $animal->hair_type = $request->hair_type; 
        $animal->castrat = $request->castrat;
        $animal->ciutat = $request->ciutat;
        $animal->size = $request->size;
        $animal->description = $request->description;
        $animal->microxip = $request->microxip;
        $animal->vacunated = $request->vacunated;
        $animal->esterizated = $request->esterizated;


        $request->photo_name->store('images', 's3');

        //$request->photo_name->store('public/uploads');
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

        $animal = Animal::findOrFail($id);

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
        $animal = Animal::find($id);
        Favourites::where('animal_id', 'like', $animal->id)->delete();
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
        return Animal::where('species', 'like', 'cannine')->get();
    }

    public function owner($owner_id)
    {
        //
        return Animal::where('owner_id', 'like', '%'.$owner_id.'%')->get();
    }



        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function advSearch(Request $request)
    {
        //
        $allAnimals = Animal::all();

        $advSearch = [];




        if ($request->name !== null) {
            foreach ($allAnimals as $animal) {
                if ($animal->name === $request->name) {
                    array_push($advSearch, $animal);
                }
            }
            $allAnimals = $advSearch;
            $advSearch = [];
        }

        if ($request->age !== null) {
            foreach ($allAnimals as $animal) {
                if ($animal->age === $request->age) {
                    array_push($advSearch, $animal);
                }
            }
            $allAnimals = $advSearch;
            $advSearch = [];
        }

        if ($request->race !== null) {
            foreach ($allAnimals as $animal) {
                if ($animal->race === $request->race) {
                    array_push($advSearch, $animal);
                }
            }
            $allAnimals = $advSearch;
            $advSearch = [];
        }

        
        if ($request->city !== null) {
            foreach ($allAnimals as $animal) {
                if ($animal->city === $request->city) {
                    array_push($advSearch, $animal);
                }
            }
            $allAnimals = $advSearch;
            $advSearch = [];
        }

        if ($request->sexe !== null) {
            foreach ($allAnimals as $animal) {
                if ($animal->sexe === $request->sexe) {
                    array_push($advSearch, $animal);
                }
            }
            $allAnimals = $advSearch;
            $advSearch = [];
        }

        if ($request->especie !== null) {
            foreach ($allAnimals as $animal) {
                if ($animal->especie === $request->especie) {
                    array_push($advSearch, $animal);
                }
            }
            $allAnimals = $advSearch;
            $advSearch = [];
        }

        if ($request->caracter !== null) {
            foreach ($allAnimals as $animal) {
                if ($animal->caracter === $request->caracter) {
                    array_push($advSearch, $animal);
                }
            }
            $allAnimals = $advSearch;
            $advSearch = [];
        }

        if ($request->hair_type !== null) {
            foreach ($allAnimals as $animal) {
                if ($animal->hair_type === $request->hair_type) {
                    array_push($advSearch, $animal);
                }
            }
            $allAnimals = $advSearch;
            $advSearch = [];
        }

        if ($request->size !== null) {
            foreach ($allAnimals as $animal) {
                if ($animal->size === $request->size) {
                    array_push($advSearch, $animal);
                }
            }
            $allAnimals = $advSearch;
            $advSearch = [];
        }

        if ($request->castrat !== null) {
            error_log($request->castrat);
            foreach ($allAnimals as $animal) {
                error_log($animal->castrat);

                if ($animal->castrat === $request->castrat) {
                    array_push($advSearch, $animal);
                }
            }
            $allAnimals = $advSearch;
            $advSearch = [];
        }

        if ($request->microxip !== null) {
            foreach ($allAnimals as $animal) {
                if ($animal->microxip === $request->microxip) {
                    array_push($advSearch, $animal);
                }
            }
            $allAnimals = $advSearch;
            $advSearch = [];
        }

        if ($request->vacunat !== null) {
            foreach ($allAnimals as $animal) {
                if ($animal->vacunat === $request->vacunat) {
                    array_push($advSearch, $animal);
                }
            }
            $allAnimals = $advSearch;
            $advSearch = [];
        }

        if ($request->desparasitat !== null) {
            foreach ($allAnimals as $animal) {
                if ($animal->desparasitat === $request->desparasitat) {
                    array_push($advSearch, $animal);
                }
            }
            $allAnimals = $advSearch;
            $advSearch = [];
        }

        return $allAnimals;
    }

    public function recomended(Request $request)
    {
        //
        $allAnimals = Animal::all();

        $advSearch = [];


        if ($request->age !== null) {
            foreach ($allAnimals as $animal) {
                if ($request->age > 60) {
                    if ($animal->species === 'feline' || ($animal->species === 'cannine' && $animal->size === 'small')){
                        array_push($advSearch, $animal);
                    }
                }
            }
            $allAnimals = $advSearch;
            $advSearch = [];
        }

        if ($request->hab !== null) {
            foreach ($allAnimals as $animal) {
                if ($request->hab === 'petita') {
                    if ($animal->species === 'feline' || ($animal->species === 'cannine' && $animal->size === 'small')){
                        array_push($advSearch, $animal);
                    }
                }
                else if ($request->hab === 'mitjana') {
                    if (($animal->species === 'cannine' && $animal->size === 'medium')){
                        array_push($advSearch, $animal);
                    }
                }
                else if ($request->hab === 'gran') {
                    if (($animal->species === 'cannine' && $animal->size === 'big')){
                        array_push($advSearch, $animal);
                    }
                }
            }
            $allAnimals = $advSearch;
            $advSearch = [];
        }

        if ($request->carcater !== null) {
            foreach ($allAnimals as $animal) {
                if ($request->carcater === 'dinamic') {
                    if ($animal->carcater === 'Juganer' || $animal->carcater === 'Equilibrado'){
                        array_push($advSearch, $animal);
                    }
                }
                else if ($request->carcater === 'independent') {
                    if ($animal->carcater === 'Independiente' || $animal->carcater === 'Equilibrado'){
                        array_push($advSearch, $animal);
                    }
                }
                else if ($request->carcater === 'tranquil') {
                    if ($animal->carcater === 'Docil' || $animal->carcater === 'Equilibrado'){
                        array_push($advSearch, $animal);
                    }
                }
                else if ($request->carcater === 'fort') {
                    if ($animal->carcater === 'Dominante' || $animal->carcater === 'Equilibrado'){
                        array_push($advSearch, $animal);
                    }
                }
            }
            $allAnimals = $advSearch;
            $advSearch = [];
        }

        if ($request->dispo !== null) {
            foreach ($allAnimals as $animal) {
                if ($request->dispo === 'alta') {
                    if ($animal->carcater === 'Juganer' || $animal->carcater === 'Dominante' || $animal->carcater === 'Equilibrado'){
                        array_push($advSearch, $animal);
                    }
                }
                else if ($request->dispo === 'poco') {
                    if ($animal->carcater === 'Independiente' || $animal->carcater === 'Docil' || $animal->carcater === 'Equilibrado'){
                        array_push($advSearch, $animal);
                    }
                }
            }
            $allAnimals = $advSearch;
            $advSearch = [];
        }
    
        return $allAnimals;
    }


}
