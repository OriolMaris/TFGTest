<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    //
    public function index()
    {
        //
        return Animal::all();
    }

    function upload(Request $req)
    {
        $result = $req->file->store('public/uploads/');
        return ["result" => $result];
    }
}
