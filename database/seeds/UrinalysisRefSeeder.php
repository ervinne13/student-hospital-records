<?php

use Illuminate\Database\Seeder;

class UrinalysisRefSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table("tbl_refurinalysis")->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('tbl_refurinalysis')->insert([
            ["scopic_exam" => "COLOR", "normal_min" => "YELLOW", "normal_max" => "YELLOW"],
            ["scopic_exam" => "TRANSPARENCY", "normal_min" => "CLEAR", "normal_max" => "CLEAR"],
            ["scopic_exam" => "REACTION", "normal_min" => 4.5, "normal_max" => 7.8],
            ["scopic_exam" => "SP_GRAVITY", "normal_min" => 1.003, "normal_max" => 1.03],
            ["scopic_exam" => "SUGAR", "normal_min" => "NEGATIVE", "normal_max" => "NEGATIVE"],
            ["scopic_exam" => "PROTEIN", "normal_min" => "NEGATIVE", "normal_max" => "NEGATIVE"]
        ]);
    }

}
