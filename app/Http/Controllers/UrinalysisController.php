<?php

namespace App\Http\Controllers;

use App\Models\Urinalysis;
use App\Models\UrinalysisRef;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class UrinalysisController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('pages.urinalysis.index');
    }

    public function datatable() {
        return Datatables::of(Urinalysis::query())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $urinalysis    = new Urinalysis();
        $urinalysisRef = UrinalysisRef::all();
        return view('pages.urinalysis.form', ["urinalysis" => $urinalysis, 'urinalysisRef' => $urinalysisRef, 'mode' => 'ADD']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        try {
            DB::statement('CALL SP_SaveUrinalysis(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', [
                $request->sy,
                $request->sem,
                $request->SN,
                $request->color,
                $request->transparency,
                $request->reaction,
                $request->sp_gravity,
                $request->sugar,
                $request->protein,
                $request->pus_cells,
                $request->red_cells,
                $request->epithelial_cells,
                $request->m_thread,
                $request->bacteria,
                $request->crystals,
                $request->others,
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
        $urinalysis    = Urinalysis::ConsolidatedId($id)->first();
        $urinalysisRef = UrinalysisRef::all();
        return view('pages.urinalysis.form', ["urinalysis" => $urinalysis, 'urinalysisRef' => $urinalysisRef, 'mode' => 'VIEW']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $urinalysis    = Urinalysis::ConsolidatedId($id)->first();
        $urinalysisRef = UrinalysisRef::all();
        return view('pages.urinalysis.form', ["urinalysis" => $urinalysis, 'urinalysisRef' => $urinalysisRef, 'mode' => 'EDIT']);
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
            DB::statement('CALL SP_SaveUrinalysis(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', [
                $request->sy,
                $request->sem,
                $request->SN,
                $request->color,
                $request->transparency,
                $request->reaction,
                $request->sp_gravity,
                $request->sugar,
                $request->protein,
                $request->pus_cells,
                $request->red_cells,
                $request->epithelial_cells,
                $request->m_thread,
                $request->bacteria,
                $request->crystals,
                $request->others,
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
