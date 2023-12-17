<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('middle_name', 255)->nullable()->before('last_name');
            $table->string('addition_name', 255)->nullable()->before('middle_name');
            $table->string('birth_place', 255)->nullable()->before('date_of_birth');
            $table->tinyInteger('employed')->default(0)->before('is_active');
            $table->dateTime('working_since')->nullable()->before('employed');
            $table->tinyInteger('is_subcontractor')->default(0)->before('working_since');
            $table->dateTime('subcontractor_since')->nullable()->before('is_subcontractor');
            $table->dateTime('vca_expiry_date')->nullable()->before('subcontractor_since');
            $table->dateTime('due_date_glass_fitter')->nullable()->before('vca_expiry_date');
            $table->dateTime('glazier_expiry_date')->nullable()->before('due_date_glass_fitter');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColum('middle_name', 255);
            $table->dropColum('addition_name', 255);
            $table->dropColum('birth_place', 255);
            $table->dropColum('employed');
            $table->dropColum('working_since');
            $table->dropColum('is_subcontractor');
            $table->dropColum('subcontractor_since');
            $table->dropColum('vca_expiry_date');
            $table->dropColum('due_date_glass_fitter');
            $table->dropColum('glazier_expiry_date');
		});
    }
}
