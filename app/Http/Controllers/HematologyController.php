<?php

namespace App\Http\Controllers;

use App\Models\Hematology;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class HematologyController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('pages.hematology.index');
    }

    public function datatable() {
        return Datatables::of(Hematology::query())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $hematology    = new Hematology();
        $hematologyRef = \App\Models\HematologyRef::all();
        return view('pages.hematology.form', ["hematology" => $hematology, "hematologyRef" => $hematologyRef, "mode" => "ADD"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        try {
            DB::statement('CALL SP_SaveHematology(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', [
                $request->sy,
                $request->sem,
                $request->SN,
                $request->hemoglobin,
                $request->hematocrit,
                $request->red_blood,
                $request->platelet,
                $request->segmenters,
                $request->lymphocytes,
                $request->monocytes,
                $request->eosinophiles,
                $request->stab_cells,
                $request->basophiles,
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
        $hematology = Hematology::ConsolidatedId($id)->first();
        $hematologyRef = \App\Models\HematologyRef::all();
        return view('pages.hematology.form', ["hematology" => $hematology, "hematologyRef" => $hematologyRef, "mode" => "VIEW"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $hematology = Hematology::ConsolidatedId($id)->first();
        $hematologyRef = \App\Models\HematologyRef::all();
        return view('pages.hematology.form', ["hematology" => $hematology, "hematologyRef" => $hematologyRef, "mode" => "EDIT"]);
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
            DB::statement('CALL SP_SaveHematology(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', [
                $request->sy,
                $request->sem,
                $request->SN,
                $request->hemoglobin,
                $request->hematocrit,
                $request->red_blood,
                $request->platelet,
                $request->segmenters,
                $request->lymphocytes,
                $request->monocytes,
                $request->eosinophiles,
                $request->stab_cells,
                $request->basophiles,
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
