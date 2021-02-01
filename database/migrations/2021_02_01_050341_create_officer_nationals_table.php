<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficerNationalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('officer_nationals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->string('email');
            $table->string('district');
            $table->string('position')->default('covid-19 health officer');
            $table->integer('number_of_patients_treated')->nullable();
            $table->string('hospital_name')->nullable();
            $table->string('upgrade')->nullable();
            $table->string('award')->default('0');
            $table->boolean('pending')->default(false);
            $table->string('monthly_allowance')->default('0');
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
        Schema::dropIfExists('officer_nationals');
    }
}
