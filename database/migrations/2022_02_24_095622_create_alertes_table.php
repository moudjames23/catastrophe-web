<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alertes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ville_id');
            $table->unsignedBigInteger('alea_id');
            $table->unsignedBigInteger('agent_id');
            $table->unsignedBigInteger('sous_prefecture_id');
            $table->string('superficie')->nullable();
            $table->date('date')->nullable();
            $table->string('personnes')->nullable();
            $table->string('mort')->default(0);
            $table->string('localite')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('image')->nullable();
            $table->string('observation')->nullable();
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
        Schema::dropIfExists('alertes');
    }
}
