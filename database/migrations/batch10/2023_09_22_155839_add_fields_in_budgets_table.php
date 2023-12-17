<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('budgets', function (Blueprint $table) {
            $table->bigInteger('relatienummer')->unsigned()->nullable();
            $table->year('budget_jaartal')->nullable();
            $table->tinyInteger('loonsom_opgegeven')->default(0);
            $table->double('overheveling_budget')->nullable();
            $table->double('loonsom_euro')->nullable();
            $table->integer('medewerkers_aantal')->nullable();
            $table->dateTime('datum_opgave')->nullable();
            $table->double('premie')->nullable();
            $table->double('vakbondsbijdr')->nullable();
            $table->double('opleidingsbudget')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('budgets', function (Blueprint $table) {
            $table->dropColumn('relatienummer');
            $table->dropColumn('budget_jaartal');
            $table->dropColumn('loonsom_opgegeven');
            $table->dropColumn('overheveling_budget');
            $table->dropColumn('loonsom_euro');
            $table->dropColumn('medewerkers_aantal');
            $table->dropColumn('datum_opgave');
            $table->dropColumn('premie');
            $table->dropColumn('vakbondsbijdr');
            $table->dropColumn('opleidingsbudget');
        });
    }
}
