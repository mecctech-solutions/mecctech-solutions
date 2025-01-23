<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->renameColumn('job_title', 'job_title_en');
            $table->string('job_title_nl')->after('job_title_en');
        });
    }

    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn('job_title_nl');
            $table->renameColumn('job_title_en', 'job_title');
        });
    }
};
