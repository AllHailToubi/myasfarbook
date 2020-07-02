<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('amenities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('icon', 255);
            $table->integer('ordre');
            $table->timestamps();
        });

        Schema::create('amenities_locals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('amenitie_id');
            $table->string('code_local', 5);
            $table->string('title', 255);
            $table->timestamps();
            $table->foreign('amenitie_id')->references('id')->on('amenities')->onDelete('cascade');
            $table->unique(['amenitie_id', 'code_local']);
        });

        

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('amenities_local');
        Schema::dropIfExists('amenities');
        
    }
}
