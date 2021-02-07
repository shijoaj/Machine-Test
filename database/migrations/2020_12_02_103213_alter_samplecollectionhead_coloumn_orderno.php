<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSamplecollectionheadColoumnOrderno extends Migration {

    private $tbl_name = 'samplecollectionhead';

    public function up() {
        if (Schema::hasTable($this->tbl_name)) {
            if (!Schema::hasColumn($this->tbl_name, 'order_no')) {
                Schema::table($this->tbl_name, function($table) {
                    $table->string('order_no', 200)->nullable();
                });
            }
        }
    }

    public function down() {
        if (Schema::hasTable($this->tbl_name)) {
            if (Schema::hasColumn($this->tbl_name, 'order_no')) {
                Schema::table($this->tbl_name, function (Blueprint $table) {
                    $table->dropColumn('order_no');
                });
            }
        }
    }

}
