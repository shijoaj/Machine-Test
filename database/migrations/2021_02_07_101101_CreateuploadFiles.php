<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateuploadFiles extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasTable('upload_docments')) {
            Schema::create('upload_docments', function (Blueprint $table) {
                $table->increments('id');
                $table->string('document_name', 500)->nullable();
                $table->string('document_name_temp', 500)->nullable();
                $table->string('document_format', 50)->nullable();
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

        if (Schema::hasTable('upload_docments')) {
            Schema::drop('upload_docments');
        }
    }

}
