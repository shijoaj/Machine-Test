<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSampleCollectionHeadTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasTable('samplecollectionhead')) {
            Schema::create('samplecollectionhead', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('patient_id')->nullable();
                $table->smallInteger('multiple_lab_ind')->nullable();
                $table->integer('lab_id')->nullable();
                $table->integer('total_amount')->nullable();
                $table->smallInteger('status')->nullable()->default(1);
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

        if (Schema::hasTable('samplecollectionhead')) {
            Schema::drop('samplecollectionhead');
        }
    }

}
