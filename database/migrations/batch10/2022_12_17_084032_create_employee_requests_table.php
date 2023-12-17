<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('last_name');
            $table->string('first_name');
            $table->dateTime('birthdate');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0: Confirmed, 1: Approved');
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
        Schema::dropIfExists('employee_requests');
    }
}
