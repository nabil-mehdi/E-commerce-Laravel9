<?php

namespace App\Http\Controllers;


use App\Models\Produit;
use App\Models\Categorie;
use App\Models\User;
use Illuminate\Http\Request;


class ControllerProduit extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produits = Produit::all();
        $pannier = session()->get('cart', []); // Utilisation d'une valeur par défaut (un tableau vide) si 'cart' n'existe pas dans la session
        return view('produit.index', compact('produits', 'pannier'));
    }

    public function form()
    {
        //appelle de la vue form.blade.php // echo "test";
        $categories = Categorie::all();
        //print_r($categories);
        return view('produit.form', array('categories' => $categories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //print_r($request->all());
        $produit = new Produit;
        $produit->designation = $request->input('designation');
        $produit->description = $request->input('description');
        $produit->prix = $request->input('prix');
        $produit->dateProduction = $request->input('dateprod');
        $produit->idCat = $request->input('cat');
        $produit->save();
        return redirect()->route('indexprod');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produits = Produit::find($id);
        //print_r($produit);
        return view('produit.show', array('produits' => $produits));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $produit = Produit::find($id);
        $categories = Categorie::all();
        return view('produit.edit', array('produit' => $produit, 'categories' => $categories));
    }

    public function update(Request $request)
    {
        $produit = Produit::find($request->input('id'));
        $produit->designation = $request->input('designation');
        $produit->description = $request->input('description');
        $produit->prix = $request->input('prix');
        $produit->qte = $request->input('stock');
        $produit->dateProduction = $request->input('dateprod');
        $produit->idCat = $request->input('cat');
        $produit->save();
        return redirect()->route('indexprod');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Produit::find($id)->delete();
        return redirect()->route('indexprod');
    }

    public function find(Request $request)
    {
        $critere = $request->input('critere');
        $produits = Produit::where('designation', 'like', "%{$critere}%")
            ->orWhere('description', 'like', "%{$critere}%")
            ->get();
        return view('produit.index', array('produits' => $produits));
    }
}
