<?php
namespace ExtensionsValley\Dashboard\Models;

use Illuminate\Database\Eloquent\Model;

class uploadDocuments extends Model {


    protected $table = 'upload_docments';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $guarded = [];

}

