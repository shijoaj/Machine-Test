<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLabTestMapTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up() {
        if (!Schema::hasTable('lab_test_map')) {
            Schema::create('lab_test_map', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('lab_id')->nullable();
                $table->integer('test_id')->nullable();
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

        if (Schema::hasTable('lab_test_map')) {
            Schema::drop('lab_test_map');
        }
    }

}
