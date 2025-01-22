<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->text('description_nl')->nullable()->change();
            $table->text('description_en')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->text('description_nl')->nullable(false)->change();
            $table->text('description_en')->nullable(false)->change();
        });
    }
};
