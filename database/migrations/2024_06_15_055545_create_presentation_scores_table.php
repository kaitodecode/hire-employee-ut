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
        Schema::create('presentation_scores', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('hired_student_id')->constrained()->cascadeOnDelete();
            $table->string('presentation_title_ps');
            $table->integer('ps_score');
            $table->string('presentation_title_ts');
            $table->integer('ts_score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presentation_scores');
    }
};
