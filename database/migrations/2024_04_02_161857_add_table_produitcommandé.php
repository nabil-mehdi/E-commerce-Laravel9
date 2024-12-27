<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prodcmd', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idProduit');
            $table->unsignedBigInteger('idCommande');
            $table->foreign('idProduit')->references('id')->on('produits');
            $table->foreign('idCommande')->references('id')->on('commandes');
            $table->integer('qte');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodcmd');
    }
};
