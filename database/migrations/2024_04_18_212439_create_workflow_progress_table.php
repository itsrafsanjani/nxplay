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
        Schema::create('workflow_progress', function (Blueprint $table) {
            $table->id();
            $table->morphs('progressable');
            $table->string('workflow_id')->index();
            $table->string('status')->comment('started, completed, failed')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workflow_progress');
    }
};
