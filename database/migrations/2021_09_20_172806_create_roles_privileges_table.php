<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesPrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_privileges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role');
            $table->unsignedBigInteger('privilege');
            $table->foreign('role')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('privilege')->references('id')->on('privileges')->onUpdate('cascade')->onDelete('cascade');
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
