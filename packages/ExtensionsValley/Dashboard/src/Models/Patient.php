<?php
namespace ExtensionsValley\Dashboard\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model {


    protected $table = 'patient';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $guarded = [];

}

