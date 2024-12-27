<?php

use App\Http\Controllers\ControllerCategorie;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerProduit;
use App\Http\Controllers\ControllerCommande;



Route::get('/', function () {
    return redirect()->route('indexprod');
});
Route::get('produit/form', [ControllerProduit::class, 'form'])->name('formprod');
Route::post('produit/store', [ControllerProduit::class, 'store'])->name('storeprod');
Route::get('produits/index', [ControllerProduit::class, 'index'])->name('indexprod');
Route::get('produit/show/{id}', [ControllerProduit::class, 'show'])->name('showprod');
Route::get('produit/del/{id}', [ControllerProduit::class, 'destroy'])->name('delprod');
Route::get('produit/edit/{id}', [ControllerProduit::class, 'edit'])->name('editprod');
Route::post('produit/update/{id}', [ControllerProduit::class, 'update'])->name('updateprod');
Route::post('produit/find', [ControllerProduit::class, 'find'])->name('findprod');
Route::post('mettreaupannier', [ControllerCommande::class, 'mettreaupannier'])->name('mettreaupannier');
Route::get('panier', [ControllerCommande::class, 'Afficherpanier'])->name('Panier');
Route::post('/clear-cart', [ControllerCommande::class, 'clearCart'])->name('clearCart');
Route::post('valider', [ControllerCommande::class, 'validercommande'])->name('validercommande');
Route::get('categorie/index', [ControllerCategorie::class, 'index'])->name('indexcat');
Route::get('categorie/form', [ControllerCategorie::class, 'form'])->name('formcat');
Route::post('categorie/store', [ControllerCategorie::class, 'store'])->name('storecat');
Route::post('pdf', [ControllerCommande::class, 'Remplirfacture'])->name('Remplirfacture');
Route::get('commande/index', [ControllerCommande::class, 'Affichercmd'])->name('Affichercmd');
Route::get('commande/detail', [ControllerCommande::class, 'Afficherdetailcmd'])->name('Afficherdetailcmd');
Route::get('pdf/view', [ControllerCommande::class, 'pdfFromView'])->name('pdfFromView');
