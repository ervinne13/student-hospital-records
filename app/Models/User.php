<?php

namespace App\Models;

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
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function get($userId) {
        return DB::select('call SP_GetUserById(?)', [$userId]);
    }

    public static function datatable() {
        return DB::select('call SP_GetUsers()');
    }

}
