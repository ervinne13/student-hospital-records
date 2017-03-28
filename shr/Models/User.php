<?php

namespace SHR\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable {

    use Notifiable;

    protected $table      = "tbl_useraccount";
    protected $primaryKey = "userid";
    public $timestamps    = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'complete_name', 'usertype'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // <editor-fold defaultstate="collapsed" desc="Scopes">

    public function scopeDatatable($query) {
        return $query->leftJoin('tbl_usertype', 'typeid', '=', 'usertype');
    }

    // </editor-fold>
    // 
    // <editor-fold defaultstate="collapsed" desc="Relationships">

    public function type() {
        return $this->hasOne(UserType::class, 'typeid', 'usertype');
    }

    // </editor-fold>
}
