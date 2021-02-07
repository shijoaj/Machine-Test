<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTestdetailsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasTable('test_master')) {
            Schema::create('test_master', function (Blueprint $table) {
                $table->increments('id');
                $table->string('test_name', 500)->nullable();
                $table->smallInteger('display_order')->nullable();
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

        if (Schema::hasTable('test_master')) {
            Schema::drop('test_master');
        }
    }

}
