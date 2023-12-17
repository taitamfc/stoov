<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNameFieldsCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->renameColumn('company_name', 'organisatie');
            $table->renameColumn('street', 'straat');
            // $table->renameColumn('number', 'number');
            $table->renameColumn('addition', 'toevoeging');
            // $table->renameColumn('post_code', 'post_code');
            $table->renameColumn('place', 'plaats');
            $table->renameColumn('glass_label', 'glaskeur');
            $table->renameColumn('contact_no', 'contact_persoon');
            $table->renameColumn('function', 'functie');
            $table->renameColumn('tax_no', 'telefoonnummer');
            $table->renameColumn('email', 'emailadres');
            $table->renameColumn('quality_mark', 'keurmerk');
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
            $table->renameColumn('organisatie', 'company_name');
            $table->renameColumn('straat', 'street');
            // $table->renameColumn('number', 'number');
            $table->renameColumn('toevoeging', 'addition');
            // $table->renameColumn('post_code', 'post_code');
            $table->renameColumn('plaats', 'place');
            $table->renameColumn('glaskeur', 'glass_label');
            $table->renameColumn('contact_persoon', 'contact_no');
            $table->renameColumn('functie', 'function');
            $table->renameColumn('telefoonnummer', 'tax_no');
            $table->renameColumn('emailadres', 'email');
            $table->renameColumn('keurmerk', 'quality_mark');
        });
    }
}
