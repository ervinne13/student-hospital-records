<?php

namespace SHR\Models;

use Illuminate\Database\Eloquent\Model;

class College extends Model {

    protected $table      = "tbl_college";
    protected $primaryKey = "collegeid";
    protected $increments = false;
    public $timestamps    = false;
    protected $fillable = [
        "college", "collegedesc"
    ];

}
