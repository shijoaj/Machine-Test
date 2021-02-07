<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLabTestMapAddColoumnAmount extends Migration {

    private $tbl_name = 'lab_test_map';

    public function up() {
        if (Schema::hasTable($this->tbl_name)) {
            if (!Schema::hasColumn($this->tbl_name, 'amount')) {
                Schema::table($this->tbl_name, function($table) {
                    $table->integer('amount')->nullable();
                });
            }
            if (!Schema::hasColumn($this->tbl_name, 'tat')) {
                Schema::table($this->tbl_name, function($table) {
                    $table->integer('tat')->nullable();
                });
            }
        }
    }

    public function down() {
        if (Schema::hasTable($this->tbl_name)) {
            if (Schema::hasColumn($this->tbl_name, 'amount')) {
                Schema::table($this->tbl_name, function (Blueprint $table) {
                    $table->dropColumn('amount');
                });
            }
            if (Schema::hasColumn($this->tbl_name, 'tat')) {
                Schema::table($this->tbl_name, function (Blueprint $table) {
                    $table->dropColumn('tat');
                });
            }
        }
    }

}
