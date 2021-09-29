<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('civilite');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('telephone')->unique();
            $table->string('photo')->nullable();
            $table->string('date_naissance')->nullable();
            $table->integer('anciennete');
            $table->enum('status', ['PARTICULIER', 'ENTREPRISE'])->nullable();
            $table->unsignedBigInteger('profil')->nullable();
            $table->unsignedBigInteger('role')->nullable();
            $table->string('pays')->nullable();
            $table->string('ville')->nullable();
            $table->string('profession')->nullable();
            $table->text('parcours')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('profil')->references('id')->on('profile_investisseurs')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('role')->references('id')->on('roles')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
