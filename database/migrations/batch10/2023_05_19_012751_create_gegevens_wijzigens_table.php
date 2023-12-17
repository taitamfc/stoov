<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGegevensWijzigensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gegevens_wijzigens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('relatienummer')->nullable();
            $table->string('naam_bedrijf')->nullable();
            $table->string('uw_naam')->nullable();
            $table->string('emailadres')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gegevens_wijzigens');
    }
}
