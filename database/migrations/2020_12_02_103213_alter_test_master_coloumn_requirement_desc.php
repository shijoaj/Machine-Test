<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTestMasterColoumnRequirementDesc extends Migration {

    private $tbl_name = 'test_master';

    public function up() {
        if (Schema::hasTable($this->tbl_name)) {
            if (!Schema::hasColumn($this->tbl_name, 'requirement_desc')) {
                Schema::table($this->tbl_name, function($table) {
                    $table->text('requirement_desc')->nullable();
                });
            }
        }
    }

    public function down() {
        if (Schema::hasTable($this->tbl_name)) {
            if (Schema::hasColumn($this->tbl_name, 'requirement_desc')) {
                Schema::table($this->tbl_name, function (Blueprint $table) {
                    $table->dropColumn('requirement_desc');
                });
            }
        }
    }

}
