<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->bigInteger('relatienummer')->nullable();
            $table->string('kvk')->nullable();
            $table->string('email_receipt')->nullable();
            $table->string('first_name')->nullable()->change();
            $table->string('last_name')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('relatienummer');
            $table->dropColumn('kvk');
            $table->dropColumn('email_receipt');
            $table->string('first_name')->change();
            $table->string('last_name')->change();
        });
    }
}
