<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->integer('position')->default(1)->change();
            DB::table('portfolio_items')->update(['position' => 1]);
        });
    }

    public function down(): void
    {
        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->integer('position')->default(0)->change();
            DB::table('portfolio_items')->update(['position' => 0]);
        });
    }
};
