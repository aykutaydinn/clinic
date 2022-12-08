<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_availabilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->boolean('Monday')->default('0');
            $table->boolean('Tuesday')->default('0');
            $table->boolean('Wednesday')->default('0');
            $table->boolean('Thursday')->default('0');
            $table->boolean('Friday')->default('0');
            $table->boolean('Saturday')->default('0');
            $table->boolean('Sunday')->default('0');
            $table->timestamps();



            $table->index('doctor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_availabilities');
    }
}
