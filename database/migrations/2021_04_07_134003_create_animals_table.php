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
            $table->string('genere');
            $table->string('race')->nullable();            
            $table->string('species')->nullable();
            $table->string('caracter')->nullable();
            $table->string('hair_type')->nullable();
            $table->string('photo_name')->nullable();
            $table->string('ciutat')->nullable();
            $table->string('size')->nullable();
            $table->string('description')->nullable();

            $table->unsignedBigInteger('owner_id');
            $table->boolean('castrat')->default(0)->nullable();
            $table->boolean('microxip')->default(0)->nullable();
            $table->boolean('vacunated')->default(0)->nullable();
            $table->boolean('esterizated')->default(0)->nullable();

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
