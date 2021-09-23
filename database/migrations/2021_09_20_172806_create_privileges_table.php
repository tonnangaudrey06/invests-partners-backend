<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privileges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role');
            $table->unsignedBigInteger('module');
            $table->boolean('consulter')->default(true);
            $table->boolean('modifier')->default(true);
            $table->boolean('ajouter')->default(true);
            $table->boolean('supprimer')->default(true);
            $table->foreign('role')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('module')->references('id')->on('modules')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('roles_privileges');
    }
}
