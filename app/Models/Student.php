<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {

    protected $table      = "tbl_studentlist";
    protected $primaryKey = "SN";
    protected $increments = false;
    public $timestamps    = false;

}
