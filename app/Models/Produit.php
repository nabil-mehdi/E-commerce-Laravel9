<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    public function categorie()
    {
        return $this->hasOne(Categorie::class, 'id', 'idCat');
    }
}
