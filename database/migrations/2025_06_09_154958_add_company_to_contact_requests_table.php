<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_requests', function (Blueprint $table) {
            $table->string('company')->after('message')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('contact_requests', function (Blueprint $table) {
            $table->dropColumn('company');
        });
    }
};
