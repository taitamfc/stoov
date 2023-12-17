<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNameFielsEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->renameColumn('middle_name', 'initialen');
            $table->renameColumn('first_name', 'tussenvoegsel');
            $table->renameColumn('addition_name', 'toevoeging');
            $table->renameColumn('last_name', 'achternaam');
            $table->renameColumn('date_of_birth', 'geboortedatum');
            $table->renameColumn('birth_place', 'geboorteplaats');
            $table->renameColumn('is_active', 'aktief');
            $table->renameColumn('employed', 'in_dienst');
            $table->renameColumn('working_since', 'indienst_sinds');
            $table->renameColumn('is_subcontractor', 'is_onderaannemer');
            $table->renameColumn('subcontractor_since', 'onderaannemer_sinds');
            $table->renameColumn('vca_expiry_date', 'vevaldatum_vca');
            $table->renameColumn('due_date_glass_fitter', 'vervaldatum_glasmonteur');
            $table->renameColumn('glazier_expiry_date', 'vervaldatum_glaszetter');
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
            $table->renameColumn('initialen', 'middle_name');
            $table->renameColumn('tussenvoegsel', 'first_name');
            $table->renameColumn('toevoeging', 'addition_name');
            $table->renameColumn('achternaam', 'last_name');
            $table->renameColumn('geboortedatum', 'date_of_birth');
            $table->renameColumn('geboorteplaats', 'birth_place');
            $table->renameColumn('aktief', 'is_active');
            $table->renameColumn('in_dienst', 'employed');
            $table->renameColumn('indienst_sinds', 'working_since');
            $table->renameColumn('is_onderaannemer', 'is_subcontractor');
            $table->renameColumn('onderaannemer_sinds', 'subcontractor_since');
            $table->renameColumn('vevaldatum_vca', 'vca_expiry_date');
            $table->renameColumn('vervaldatum_glasmonteur', 'due_date_glass_fitter');
            $table->renameColumn('vervaldatum_glaszetter', 'glazier_expiry_date');
        });
    }
}
