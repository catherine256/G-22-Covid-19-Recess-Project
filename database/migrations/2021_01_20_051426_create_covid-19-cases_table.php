<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovid19CasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covid-19-cases', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->string('gender');
            $table->string('category');
            $table->string('officer_name');
            $table->string('hospital_name');
            $table->timestamp('date_registered')->usecurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('covid-19-cases');
    }
}
