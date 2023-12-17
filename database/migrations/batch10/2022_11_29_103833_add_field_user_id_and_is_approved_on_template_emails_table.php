<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldUserIdAndIsApprovedOnTemplateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('template_emails', function (Blueprint $table) {
            $table->bigInteger('user_id')->nullable();
            $table->tinyInteger('is_approved')->default(0);
            $table->double('amount_total')->default(0);
            $table->double('amount_request')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('template_emails', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('is_approved');
            $table->dropColumn('amount_total');
            $table->dropColumn('amount_request');
        });
    }
}
