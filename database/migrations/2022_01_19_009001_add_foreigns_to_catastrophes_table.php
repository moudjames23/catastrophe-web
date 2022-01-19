<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToCatastrophesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catastrophes', function (Blueprint $table) {
            $table
                ->foreign('alea_id')
                ->references('id')
                ->on('aleas')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('ville_id')
                ->references('id')
                ->on('villes')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catastrophes', function (Blueprint $table) {
            $table->dropForeign(['alea_id']);
            $table->dropForeign(['ville_id']);
        });
    }
}
