<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class MainAdminUserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table("tbl_useraccount")->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $user                = new User();
        $user->username      = "Administrator";
        $user->password      = \Hash::make("password");
        $user->complete_name = "Administrator";
        $user->usertype      = 999;

        $user->save();
    }

}
