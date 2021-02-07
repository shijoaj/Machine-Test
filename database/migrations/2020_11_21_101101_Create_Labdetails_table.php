<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLabdetailsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasTable('lab_master')) {
            Schema::create('lab_master', function (Blueprint $table) {
                $table->increments('id');
                $table->string('lab_code', 500)->nullable();
                $table->string('lab_name', 500)->nullable();
                $table->string('location', 500)->nullable();
                $table->string('address', 500)->nullable();
                $table->smallInteger('status')->nullable()->default(1);
                $table->string('phone', 255)->nullable();
                $table->string('email', 500)->nullable();
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

        if (Schema::hasTable('lab_master')) {
            Schema::drop('lab_master');
        }
    }

}
