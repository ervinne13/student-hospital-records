<?php

namespace App\Http\Controllers;

use App\Modes\VitalSigns;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class VitalSignsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('pages.vital-signs.index');
    }

    public function datatable() {
        return Datatables::of(VitalSigns::query())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $currentUser = Auth::user();
        $vitalSigns  = new VitalSigns();

        if ($currentUser->usertype == 100) {
            $vitalSigns->license_no = $currentUser->physician_license_no;
        }

        return view('pages.vital-signs.form', ['vitalSigns' => $vitalSigns, 'mode' => 'ADD']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        try {
            DB::statement('CALL SP_SaveVitalSigns(?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', [
                $request->sy,
                $request->sem,
                $request->SN,
                $request->pulse_rate,
                $request->blood_pressure,
                $request->vision,
                $request->color_vision,
                $request->hearing,
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
        $vitalSigns = VitalSigns::ConsolidatedId($id)->first();
        return view('pages.vital-signs.form', ['vitalSigns' => $vitalSigns, 'mode' => 'VIEW']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $vitalSigns = VitalSigns::ConsolidatedId($id)->first();
        return view('pages.vital-signs.form', ['vitalSigns' => $vitalSigns, 'mode' => 'EDIT']);
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
            DB::statement('CALL SP_SaveVitalSigns(?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', [
                $request->sy,
                $request->sem,
                $request->SN,
                $request->pulse_rate,
                $request->blood_pressure,
                $request->vision,
                $request->color_vision,
                $request->hearing,
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
