<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('outreach_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prospect_id')->constrained()->cascadeOnDelete();
            $table->foreignId('outreach_template_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('follow_up_to_id')->nullable()->constrained('outreach_attempts')->nullOnDelete();
            $table->string('subject');
            $table->text('body');
            $table->timestamp('sent_at')->nullable();
            $table->string('outcome')->nullable();
            $table->text('outcome_note')->nullable();
            $table->timestamp('outcome_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('outreach_attempts');
    }
};
