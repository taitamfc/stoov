<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->string('thema')->nullable();
            $table->float('percentage')->nullable();
            $table->tinyInteger('is_active')->comment('0:acitve, 1:inactive');
            $table->tinyInteger('vakcertificaat_glaszetten')->comment('0:uncheck, 1:checked');
            $table->tinyInteger('vakcertificaat_glasmonteur')->comment('0:uncheck, 1:checked');
            $table->tinyInteger('op_termijn_moeten_we_deze_gaan_bijhouden')->comment('0:uncheck, 1:checked');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            //
        });
    }
}
