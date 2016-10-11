<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SYSemSNBaseModel extends Model {

    public function scopeConsolidatedId($query, $id) {
        $idParts = explode("|", $id);
        if (count($idParts) < 3) {
            throw new Exception("Invalid id {$id}");
        }

        return $query
                        ->where("sy", $idParts[0])
                        ->where("sem", $idParts[1])
                        ->where("SN", $idParts[2])
        ;
    }

}
