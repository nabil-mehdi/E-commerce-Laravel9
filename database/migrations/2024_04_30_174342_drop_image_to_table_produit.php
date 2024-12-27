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
        if (!Schema::hasColumn('produits', 'image')) {
            Schema::table('produits', function (Blueprint $table) {
                $table->string('image')->nullable()->after('prix');
            });
        }
    }

    /**
     * Inverse les migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('produits', 'image')) {
            Schema::table('produits', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }
    }
};
