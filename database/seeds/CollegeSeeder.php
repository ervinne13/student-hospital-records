<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use SHR\Models\College;

class CollegeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table("tbl_college")->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $colleges = [
            ["college" => "COE", "collegedesc" => "College of Engineering"],
            ["college" => "CBA", "collegedesc" => "College of Business Administration"],
        ];

        College::insert($colleges);
    }

}
