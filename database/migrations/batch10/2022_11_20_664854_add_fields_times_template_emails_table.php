<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsTimesTemplateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('template_emails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email', 100)->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::table('template_emails', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            $table->dropColumn('email');
            $table->dropColumn('status');
        });
    }
}
