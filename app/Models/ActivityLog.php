<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model {

    protected $table      = "tbl_activitylog";
    protected $primaryKey = "logno";
    public $timestamps    = false;
    protected $fillable   = [
        "logdesc", "logdate", "loguser"
    ];

    public function scopeDatatable($query) {
        return $query->leftJoin('tbl_useraccount', 'loguser', '=', 'userid');
    }

}
