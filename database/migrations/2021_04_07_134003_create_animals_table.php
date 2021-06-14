<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('age');
            $table->string('sexe');
            $table->string('race')->nullable();            
            $table->string('species');
            $table->string('photo_name');
            // taula del caracter del animal
            // taula vacunes del animal
            $table->unsignedBigInteger('owner_id');

            $table->string('caracter');
            $table->string('hair_type')->nullable();
            $table->boolean('castrat')->default(0);
            $table->string('ciutat');
            $table->string('size');
            $table->string('description')->nullable();
            $table->boolean('microxip')->default(0);
            $table->boolean('vacunated')->default(0);
            $table->boolean('esterizated')->default(0);

            $table->foreign('owner_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('animals');
    }
}
