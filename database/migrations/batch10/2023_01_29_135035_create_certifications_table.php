<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->dateTime('datum_uitgifte_vca')->nullable();
            $table->dateTime('vervaldatum_vca')->nullable();
            $table->string('certificaatnummer')->nullable();
            $table->string('gewenste_certificatie')->nullable();
            $table->string('pasje_gecertificeerd_glasmonteur')->nullable();
            $table->dateTime('datum_gecertificeerd_glasmonteur')->nullable();
            $table->dateTime('vervaldatum_gecertificeerd_glasmonteur')->nullable();
            $table->string('examen_glasmonteur')->nullable();
            $table->string('examencode_glasmonteur')->nullable();
            $table->tinyInteger('hercertificering_glasmonteur')->default(0);
            $table->dateTime('datum_hercertificering_glasmonteur')->nullable();
            $table->dateTime('vervaldatum_hercertificering_glasmonteur')->nullable();
            $table->string('hercertificeringscode_glasmonteur')->nullable();
            $table->string('hercertificeringscijfer_glasmonteur')->nullable();
            $table->string('hercertificeringspasnummer_glasmonteur')->nullable();
            $table->string('pasje_gecertificeerd_glaszetter')->nullable();
            $table->dateTime('datum_gecertificeerd_glaszetter')->nullable();
            $table->dateTime('vervaldatum_gecertificeerd_glaszetter')->nullable();
            $table->string('examen_glaszetter')->nullable();
            $table->string('examencode_glaszetter')->nullable();
            $table->integer('examencijfer_glaszetter')->nullable();
            $table->tinyInteger('hercertificering_glaszetter')->default(0);
            $table->dateTime('datum_hercertificering_glaszetter')->nullable();
            $table->dateTime('vervaldatum_hercertificering_glaszetter')->nullable();
            $table->string('hercertificeringscode_glaszetter')->nullable();
            $table->string('hercertificeringscijfer_glaszetter')->nullable();
            $table->string('hercertificeringspasnummer_glaszetter')->nullable();
            $table->text('notitie')->nullable();
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
        Schema::dropIfexists('certifications');
    }
}
