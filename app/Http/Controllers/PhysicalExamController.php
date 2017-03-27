<?php

namespace App\Http\Controllers;

use App\Models\PhysicalExam;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class PhysicalExamController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('pages.pe.index');
    }

    public function datatable() {
        return Datatables::of(PhysicalExam::query())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $currentUser = Auth::user();
        $pe          = new PhysicalExam();

        if ($currentUser->usertype == 100) {
            $pe->license_no = $currentUser->physician_license_no;
        }

        return view('pages.pe.form', ['pe' => $pe, 'mode' => 'ADD']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        try {
            DB::statement('CALL SP_SavePE(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', [
                $request->sy,
                $request->sem,
                $request->SN,
                $request->skin,
                $request->head_scalp,
                $request->eyes_external,
                $request->pupils_opthatmoscopic,
                $request->ears,
                $request->nose_sinuses,
                $request->mouth_throat,
                $request->neck_ln_thyroid,
                $request->chest_breast_axilla,
                $request->lungs,
                $request->heart,
                $request->abdomen,
                $request->back,
                $request->anus_rectum,
                $request->gu_system,
                $request->reflexes,
                $request->extremities,
                $request->license_no,
                Auth::user()->userid
            ]);

            return "OK";
        } catch (QueryException $e) {
            return response($e->getMessage(), 500);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $pe = PhysicalExam::ConsolidatedId($id)->first();
        return view('pages.pe.form', ['pe' => $pe, 'mode' => 'VIEW']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $pe = PhysicalExam::ConsolidatedId($id)->first();
        return view('pages.pe.form', ['pe' => $pe, 'mode' => 'EDIT']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        try {
            DB::statement('CALL SP_SavePE(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', [
                $request->sy,
                $request->sem,
                $request->SN,
                $request->skin,
                $request->head_scalp,
                $request->eyes_external,
                $request->pupils_opthatmoscopic,
                $request->ears,
                $request->nose_sinuses,
                $request->mouth_throat,
                $request->neck_ln_thyroid,
                $request->chest_breast_axilla,
                $request->lungs,
                $request->heart,
                $request->abdomen,
                $request->back,
                $request->anus_rectum,
                $request->gu_system,
                $request->reflexes,
                $request->extremities,
                $request->license_no,
                Auth::user()->userid
            ]);

            return "OK";
        } catch (QueryException $e) {
            return response($e->getMessage(), 500);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
