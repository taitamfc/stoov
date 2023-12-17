<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->year('year');
            $table->float('amount');
            $table->unsignedBigInteger('client_id')->nullable();
			$table->unsignedBigInteger('company_id')->nullable();
            
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
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
        Schema::dropIfExists('budgets');
    }
}
