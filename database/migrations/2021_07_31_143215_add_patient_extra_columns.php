<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPatientExtraColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'chronicDiseases')){
            $table->string('chronicDiseases')->nullable();
            }

            if (!Schema::hasColumn('users', 'medicareNumber')){
                $table->string('medicareNumber')->nullable()->unique();
                }

            if (!Schema::hasColumn('users', 'address')){
                $table->string('address')->nullable();
                }
            
            if (!Schema::hasColumn('users', 'suburb')){
                $table->string('suburb')->nullable();
                }

            if (!Schema::hasColumn('users', 'state')){
                $table->string('state')->nullable();
                }
            
            if (!Schema::hasColumn('users', 'gender')){
                $table->string('gender')->nullable();
                }
            
            if (!Schema::hasColumn('users', 'covidVaccinatedStatus')){
                $table->string('covidVaccinatedStatus')->nullable();
                }
            
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['chronicDiseases']);
            $table->dropColumn(['medicareNumber']);
            $table->dropColumn(['address']);
            $table->dropColumn(['suburb']);
            $table->dropColumn(['state']);
            $table->dropColumn(['gender']);
            $table->dropColumn(['covidVaccinatedStatus']);
        });
    }
}
