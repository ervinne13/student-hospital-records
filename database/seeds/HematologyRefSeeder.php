<?php

use Illuminate\Database\Seeder;

class HematologyRefSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table("tbl_refhematology")->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table("tbl_refhematology")->insert([
            ["com_bld_count" => "HEMOGLOBIN_M", "normal_min" => 140, "normal_max" => 170, "unit" => "g/L"],
            ["com_bld_count" => "HEMOGLOBIN_F", "normal_min" => 120, "normal_max" => 150, "unit" => "g/L"],
            ["com_bld_count" => "HEMATOCRIT_M", "normal_min" => 0.42, "normal_max" => 0.52, "unit" => "%"],
            ["com_bld_count" => "HEMATOCRIT_F", "normal_min" => 0.37, "normal_max" => 0.47, "unit" => "%"],
            ["com_bld_count" => "RED_CELL_COUNT_M", "normal_min" => 4.5, "normal_max" => 5.5, "unit" => "10X12/I"],
            ["com_bld_count" => "RED_CELL_COUNT_F", "normal_min" => 3.8, "normal_max" => 5.0, "unit" => "10X12/I"],
            ["com_bld_count" => "WHITE_CELL_COUNT", "normal_min" => 4.5, "normal_max" => 11, "unit" => "10X9/L"],
            ["com_bld_count" => "SEGMENTERS", "normal_min" => 0.5, "normal_max" => 0.7, "unit" => "%"],
            ["com_bld_count" => "LYMPHOCYTES", "normal_min" => 0.2, "normal_max" => 0.4, "unit" => "%"],
            ["com_bld_count" => "MONOCYTES", "normal_min" => 0.01, "normal_max" => 0.06, "unit" => "%"],
            ["com_bld_count" => "EOSINOPHILES", "normal_min" => 0.01, "normal_max" => 0.05, "unit" => "%"],
            ["com_bld_count" => "STAB_CELLS", "normal_min" => 0.03, "normal_max" => 0.06, "unit" => "%"],
            ["com_bld_count" => "BASOPHILES", "normal_min" => 0, "normal_max" => 0.01, "unit" => "%"],
            ["com_bld_count" => "PLATELET_COUNT", "normal_min" => 150, "normal_max" => 400, "unit" => "X10 9/I"],
        ]);
    }

}
