<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class College extends Model {

    protected $table      = "tbl_studentlist";
    protected $primaryKey = "collegeid";
    protected $increments = false;
    public $timestamps    = false;

}
