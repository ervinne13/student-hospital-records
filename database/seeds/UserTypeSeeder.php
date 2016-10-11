<?php

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table("tbl_usertype")->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $types = [
            ["typeid" => 100, "userdesc" => "PHYSICIAN"],
            ["typeid" => 101, "userdesc" => "REGISTER"],
            ["typeid" => 102, "userdesc" => "URINALYSIS"],
            ["typeid" => 103, "userdesc" => "XRAY"],
            ["typeid" => 104, "userdesc" => "PHY EX"],
            ["typeid" => 105, "userdesc" => "CBC"],
            ["typeid" => 201, "userdesc" => "MEDICAL"],
            ["typeid" => 999, "userdesc" => "ADMIN"],
        ];

        UserType::insert($types);
    }

}
