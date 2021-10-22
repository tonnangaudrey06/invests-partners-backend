<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActualitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actualites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('secteur');
            $table->unsignedBigInteger('projet');
            $table->string('libelle');
            $table->text('description');
            $table->boolean('publier')->default(false);
            $table->foreign('secteur')->references('id')->on('secteurs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('projet')->references('id')->on('projets')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actualites');
    }
}
