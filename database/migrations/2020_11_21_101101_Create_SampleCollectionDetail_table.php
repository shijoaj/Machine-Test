<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSampleCollectionDetailTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasTable('samplecollectiondetails')) {
            Schema::create('samplecollectiondetails', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('head_id')->nullable();
                $table->integer('lab_id')->nullable();
                $table->integer('test_id')->nullable();
                $table->integer('amount')->nullable();
                $table->integer('tat')->nullable();
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

        if (Schema::hasTable('samplecollectiondetails')) {
            Schema::drop('samplecollectiondetails');
        }
    }

}
