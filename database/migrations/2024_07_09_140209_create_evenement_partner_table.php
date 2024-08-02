<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEenementPartnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evenement_partner', function (Blueprint $table) {
            $table->id();
            $table->foreign('evenement')->references('id')->on('evenements')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('partenaire')->references('id')->on('partenaires')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('enenement_partner');
    }
}
