<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CreateStoredProcedures extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $files = File::allFiles(storage_path('queries'));

        DB::beginTransaction();
        try {
            foreach ($files as $file) {
                $queryString = File::get($file);
                DB::unprepared($queryString);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::unprepared("DROP procedure IF EXISTS SP_GetUserById");
        DB::unprepared("DROP procedure IF EXISTS SP_GetUsers");
        DB::unprepared("DROP procedure IF EXISTS SP_RegisterUserAccount");
        DB::unprepared("DROP procedure IF EXISTS SP_UpdateUserAccount");
        DB::unprepared("DROP procedure IF EXISTS SP_SaveCollege");

        //  Datatables
        DB::unprepared("DROP procedure IF EXISTS SP_UsersDatatable");
        DB::unprepared("DROP procedure IF EXISTS SP_StudentsDatatable");
        DB::unprepared("DROP procedure IF EXISTS SP_StudentsDatatable");
        DB::unprepared("DROP procedure IF EXISTS SP_UrinalysisDatatable");
        DB::unprepared("DROP procedure IF EXISTS SP_HematologyDatatable");
        DB::unprepared("DROP procedure IF EXISTS SP_PEDatatable");

        //  Laboratory
        DB::unprepared("DROP procedure IF EXISTS SP_SaveXRay");
        DB::unprepared("DROP procedure IF EXISTS SP_SaveHematology");
        DB::unprepared("DROP procedure IF EXISTS SP_SaveVitalSigns");
        DB::unprepared("DROP procedure IF EXISTS SP_SavePE");
        DB::unprepared("DROP procedure IF EXISTS SP_SaveUrinalysis");
        DB::unprepared("DROP procedure IF EXISTS SP_SaveMedicalHistory");

        DB::unprepared("DROP procedure IF EXISTS SP_SaveCertifiation");
    }

}
