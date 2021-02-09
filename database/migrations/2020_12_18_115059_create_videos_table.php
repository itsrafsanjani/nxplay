<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->unsignedBigInteger('views')->default(0);
            $table->string('runtime', 10);
            $table->string('year', 10);
            $table->string('imdb_id',9)->unique();
            $table->decimal('imdb_rating', 3,1);
            $table->string('genres');
            $table->string('country');
            $table->string('type', 20);
            $table->string('directors');
            $table->text('actors');
            $table->string('box_office', 50)->nullable();
            $table->string('poster');
            $table->string('video');
            $table->longText('photos');
            $table->string('age_rating', 10);
            $table->boolean('status');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
