<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categorie')->nullable();
            $table->unsignedBigInteger('user')->nullable();
            $table->enum('etat', ['IDEE', 'PROTOTYPE', 'SUR_LE_MARCHE'])->default('IDEE');
            $table->boolean('publier')->default(false);
            $table->boolean('clotuer')->default(false);
            $table->string('email_personne_contacter');
            $table->string('telephone_personne_contacter');
            $table->string('intitule');
            $table->text('description');
            $table->boolean('complet')->default(false);
            $table->string('logo')->nullable();
            $table->foreign('categorie')->references('id')->on('categories')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('projets');
    }
}
