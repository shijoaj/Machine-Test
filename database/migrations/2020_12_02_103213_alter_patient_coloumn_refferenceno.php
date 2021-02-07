<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPatientColoumnRefferenceno extends Migration {

    private $tbl_name = 'patient';

    public function up() {
        if (Schema::hasTable($this->tbl_name)) {
            if (!Schema::hasColumn($this->tbl_name, 'reference_no')) {
                Schema::table($this->tbl_name, function($table) {
                   $table->string('reference_no', 200)->nullable();
                });
            }
        }
    }

    public function down() {
        if (Schema::hasTable($this->tbl_name)) {
            if (Schema::hasColumn($this->tbl_name, 'reference_no')) {
                Schema::table($this->tbl_name, function (Blueprint $table) {
                    $table->dropColumn('reference_no');
                });
            }
        }
    }

}
