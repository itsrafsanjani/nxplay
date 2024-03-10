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
        Schema::table('videos', function (Blueprint $table) {
            // Drop the existing unique constraint
            $table->dropUnique('videos_imdb_id_unique');

            // Modify the 'imdb_id' column to increase its length
            $table->string('imdb_id')->change();

            // Add back the unique constraint
            $table->unique('imdb_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            // nothing to do here
        });
    }
};
