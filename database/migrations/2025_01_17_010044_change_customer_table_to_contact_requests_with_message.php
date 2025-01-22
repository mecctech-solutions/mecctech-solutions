<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('customers', 'contact_requests');
        Schema::table('contact_requests', function (Blueprint $table) {
            $table->text('message')->after('email');
        });
    }

    public function down(): void
    {
        Schema::rename('contact_requests', 'customers');
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('message');
        });
    }
};
