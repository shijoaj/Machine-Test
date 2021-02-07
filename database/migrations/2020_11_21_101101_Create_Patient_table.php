<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePatientTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasTable('patient')) {
            Schema::create('patient', function (Blueprint $table) {
                $table->increments('id');
                $table->string('patient_name', 500)->nullable();
                $table->string('patient_id', 500)->nullable();
                $table->string('age', 20)->nullable();
                $table->smallInteger('age_type')->nullable();
                $table->string('phone', 255)->nullable();
                $table->string('email', 500)->nullable();
                $table->smallInteger('gender')->nullable();
                $table->integer('created_by')->nullable();
                $table->integer('updated_by')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        if (Schema::hasTable('patient')) {
            Schema::drop('patient');
        }
    }

}
