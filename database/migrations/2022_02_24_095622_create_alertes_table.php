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
            $table->string('superficie');
            $table->date('date');
            $table->string('personnes');
            $table->string('localite');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('image');
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
