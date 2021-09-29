<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membres', function (Blueprint $table) {
            $table->id();
            $table->string('nom_membre');
            $table->string('telephone_membre');
            $table->string('email_membre');
            $table->string('photo_membre')->nullable();            
            $table->string('cni_membre')->nullable();          
            $table->string('pays_membre')->nullable();          
            $table->string('ville_membre')->nullable();          
            $table->string('profession_membre')->nullable();            
            $table->string('date_naissance_membre')->nullable(); 
            $table->text('parcours_membre')->nullable(); 
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
        Schema::dropIfExists('membres');
    }
}
