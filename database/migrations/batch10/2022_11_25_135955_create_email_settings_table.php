<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Course;

class CreateEmailSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('type')->default(Course::TYPE_VERLETVERGOEDING);
            $table->string('subject', 255);
            $table->text('content');
            $table->string('button_text', 255)->nullable();
            $table->text('cc_email')->nullable();
            $table->text('bcc_email')->nullable();
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
        Schema::dropIfExists('email_settings');
    }
}
