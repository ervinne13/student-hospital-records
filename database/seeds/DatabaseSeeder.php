<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call(UserTypeSeeder::class);
        $this->call(MainAdminUserSeeder::class);
        $this->call(CollegeSeeder::class);
        $this->call(UrinalysisRefSeeder::class);
        $this->call(HematologyRefSeeder::class);
    }

}
