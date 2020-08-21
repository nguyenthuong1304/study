<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->bigInteger('liker_id')->unsigned();
            $table->bigInteger('likee_id')->unsigned();
            $table->foreign('liker_id')->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('likee_id')->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->unique(['liker_id', 'likee_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}
