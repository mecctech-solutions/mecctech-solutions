<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bullet_points', function (Blueprint $table) {
            $table->integer('position')->after('id')->default(1);
        });
    }

    public function down(): void
    {
        Schema::table('bullet_points', function (Blueprint $table) {
            $table->dropColumn('position');
        });
    }
};
