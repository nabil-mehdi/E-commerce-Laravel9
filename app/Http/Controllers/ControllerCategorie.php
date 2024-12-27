<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\View\ViewServiceProvider;

class ControllerCategorie extends Controller
{

    public function index()
    {
        // Assuming the view is located at resources/views/categorie.blade.php
        return view('categorie.index');
    }
    public function form()
    {
        // Assuming the view is located at resources/views/categorie.blade.php
        return view('categorie.form');
    }
    public function store(Request $request)
    {
        //print_r($request->all());
        $categorie = new Categorie();
        $categorie->designation = $request->input('designation');
        $categorie->description = $request->input('description');
        $categorie->save();
        return redirect()->route('indexprod');
    }
}
