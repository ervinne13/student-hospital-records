<?php

namespace App\Http\Controllers;

use App\Models\XRay;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class XRayController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('pages.xray.index');
    }

    public function datatable() {
        return Datatables::of(XRay::query())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $xray = new XRay();
        return view('pages.xray.form', ["xray" => $xray, "mode" => "ADD"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        try {
            DB::statement('CALL SP_SaveXRay(?, ?, ?, ?, ?);', [
                $request->sy,
                $request->sem,
                $request->SN,
                $request->findings,
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $xray = XRay::ConsolidatedId($id)->first();

        if ($xray) {
            return view('pages.xray.form', ["xray" => $xray, "mode" => "EDIT"]);
        } else {
            return response("Record not found", 404);
        }
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
            DB::statement('CALL SP_SaveXRay(?, ?, ?, ?, ?);', [
                $request->sy,
                $request->sem,
                $request->SN,
                $request->findings,
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
