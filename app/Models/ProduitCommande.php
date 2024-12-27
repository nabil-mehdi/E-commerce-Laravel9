<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProduitCommande extends Model
{
    use HasFactory;
    protected $table = 'prodcmd';

    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class, 'idCommande');
    }
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'idProduit');
    }
}
