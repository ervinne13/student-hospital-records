<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SHR\Models\College;
use Yajra\Datatables\Datatables;

class CollegesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('pages.colleges.index');
    }

    public function datatable() {
        return Datatables::of(College::query())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $college = new College();
        return view('pages.colleges.form', ['college' => $college, 'mode' => "ADD"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {

        try {
            DB::beginTransaction();
            $college = new College($request->toArray());
            $college->save();
            ActivityLog::insert([
                "logdesc" => "Created new college {$college->college}",
                "loguser" => Auth::user()->userid
            ]);
            DB::commit();
            return $college;
        } catch (Exception $e) {
            DB::rollBack();
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
        $college = College::find($id);
        return view('pages.colleges.form', ['college' => $college, 'mode' => "EDIT"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $college = College::find($id);

        if ($college) {
            try {
                DB::beginTransaction();
                $college->fill($request->toArray());
                $college->save();
                ActivityLog::insert([
                    "logdesc" => "Updated college {$college->college}",
                    "loguser" => Auth::user()->userid
                ]);
                DB::commit();
                return $college;
            } catch (Exception $e) {
                DB::rollBack();
                return response($e->getMessage(), 500);
            }
        } else {
            return response("College Not Found", 404);
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
