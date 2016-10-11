<?php

namespace SHR\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {

    protected $table      = "tbl_studentlist";
    protected $primaryKey = "SN";
    public $incrementing  = false;
    public $timestamps    = false;
    protected $fillable   = [
        "SN",
        "first_name",
        "last_name",
        "collegecde",
        "course",
        "age",
        "gender",
        "yearlevel",
        "address",
        "weight",
        "height",
        "complexion",
        "civil_status",
        "cp_no",
        "tel_no",
        "bday",
        "status",
    ];

    public function scopeDatatable($query) {
        return $query->leftJoin('tbl_college', 'collegeid', '=', 'collegecde');
    }

    public function college() {
        return $this->belongsTo(College::class, 'collegecde');
    }

}
