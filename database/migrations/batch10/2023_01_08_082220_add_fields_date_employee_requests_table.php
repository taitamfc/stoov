<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsDateEmployeeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_requests', function (Blueprint $table) {
            $table->tinyInteger('is_subcontractor')->nullable();
            $table->dateTime('working_since')->nullable();
            $table->dateTime('vca_expiry_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_requests', function (Blueprint $table) {
            $table->dropColumn('is_subcontractor');
            $table->dropColumn('working_since');
            $table->dropColumn('vca_expiry_date');
        });
    }
}
