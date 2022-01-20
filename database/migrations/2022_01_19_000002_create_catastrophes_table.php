<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatastrophesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catastrophes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('valeur')->nullable();
            $table->string('url')->nullable();
            $table->unsignedBigInteger('alea_id');
            $table->unsignedBigInteger('ville_id');

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
        Schema::dropIfExists('catastrophes');
    }
}
