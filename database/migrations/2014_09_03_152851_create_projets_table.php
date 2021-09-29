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
            $table->boolean('en_attente')->default(false);
            $table->boolean('accepté')->default(false);
            $table->boolean('publié')->default(false);
            $table->string('intitule');
            $table->string('media')->nullable();
            $table->string('doc_presentation');
            $table->string('pays_activite');
            $table->string('ville_activite');
            $table->string('site')->nullable();
            $table->text('description');
<<<<<<< HEAD
            $table->boolean('complet')->default(false);
=======
            $table->integer('financement');
>>>>>>> bfc238138504c70fe66684621e333f5295bb14cf
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
