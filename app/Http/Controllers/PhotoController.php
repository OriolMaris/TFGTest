<?php

namespace App\Http\Controllers;

use App\Models\Photo;

use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Photo::all();
    }

    function upload(Request $req)
    {

        //$path = $req->photo->store('images');

        $result = $req->photo->store('public/uploads');
        $file_name = $req->photo->hashName();
        $photo = new Photo();
        $photo->animal_id = $req->animal_id;
        $photo->photo_path = $file_name;
        $photo->save();

        return ["result" => $photo];
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'animal_id' => 'required',
            'photo_path' => 'required',
        ]);

        return Animal::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($photo)
    {
        //
        //$result = Photo::find($id);
        //$photo_path = $result->photo_path; 
        //response()->download('storage/uploads/'.$photo_path);  this is the one   9i9sg35Kxcl7WPIHkrq4JNJDAiU7y6ximURFnkgP.jpg
        //return response()->download('storage/uploads/9i9sg35Kxcl7WPIHkrq4JNJDAiU7y6ximURFnkgP.jpg')
        //return ['result' => $photo];
        return response()->download('storage/uploads/'.$photo);
        //return response()->download('images', 'N2AEwYRRt5wmtdG3UcjufAV1TJ03r1tRcukvDXME');
        //return response()->download($photo_path);

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
        $animal = Photo::find($id);
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
        Photo::destroy($id);
    }


    /**
     * Search of a race.
     *
     * @param  str  $race
     * @return \Illuminate\Http\Response
     */
    public function  search($id)
    {
        //
        return Photo::where('animal_id', $id)->get();
    }
}
