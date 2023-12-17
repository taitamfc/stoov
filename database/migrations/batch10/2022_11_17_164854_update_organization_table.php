<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('street', 255)->default(null)->nullable();
            $table->string('number', 255)->default(null)->nullable();
            $table->string('addition', 255)->default(null)->nullable();
            $table->string('post_code', 255)->default(null)->nullable();
            $table->string('place', 255)->default(null)->nullable();
            $table->string('glass_label', 255)->default(null)->nullable();
            $table->string('function', 255)->default(null)->nullable();
            $table->string('quality_mark', 255)->default(null)->nullable();

            $table->dropForeign(['location_id']);
            $table->dropColumn('location_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColum('street');
            $table->dropColum('number');
            $table->dropColum('addition');
            $table->dropColum('post_code');
            $table->dropColum('place');
            $table->dropColum('glass_label');
            $table->dropColum('function');
            $table->dropColum('quality_mark');
        });
    }
}
