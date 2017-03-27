<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SHR\Models\College;
use SHR\Models\Student;
use Yajra\Datatables\Datatables;

class StudentsController extends Controller {

    protected $yearLevels        = [
        ["value" => 1, "display" => "1st"],
        ["value" => 2, "display" => "2nd"],
        ["value" => 3, "display" => "3rd"],
        ["value" => 4, "display" => "4th"],
        ["value" => 5, "display" => "5th"]
    ];
    protected $genders           = [
        ["value" => "M", "display" => "Male"],
        ["value" => "F", "display" => "Female"]
    ];
    protected $civilStatusList   = [
        ["value" => "SINGLE", "display" => "Single"],
        ["value" => "MARRIED", "display" => "Married"],
        ["value" => "SEPARATED", "display" => "Separated"],
        ["value" => "DIVORCED", "display" => "Divorced"],
        ["value" => "WIDOWED", "display" => "Widowed"],
    ];
    protected $illnessStatusList = [
        ["value" => 0, "display" => "Healthy"],
        ["value" => 1, "display" => "Has Illness"]
    ];

    public function index() {
        return view('pages.students.index');
    }

    public function datatable() {
        return Datatables::of(Student::datatable())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $student  = new Student();
        $colleges = College::all();
        return view('pages.students.form', [
            'student'           => $student,
            "colleges"          => $colleges,
            "yearLevels"        => $this->yearLevels,
            "genders"           => $this->genders,
            "civilStatusList"   => $this->civilStatusList,
            "illnessStatusList" => $this->illnessStatusList,
            'mode'              => "ADD"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {

        $student = new Student();

        try {
            $requestAssoc = $request->toArray();
            $student->fill($requestAssoc);
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }

        try {
            DB::beginTransaction();
            $student->save();
            ActivityLog::insert([
                "logdesc" => "Created student {$student->SN}",
                "loguser" => Auth::user()->userid
            ]);
            DB::commit();
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
        $student  = Student::find($id);
        $colleges = College::all();
        return view('pages.students.form', [
            'student'           => $student,
            "colleges"          => $colleges,
            "yearLevels"        => $this->yearLevels,
            "genders"           => $this->genders,
            "civilStatusList"   => $this->civilStatusList,
            "illnessStatusList" => $this->illnessStatusList,
            'mode'              => "VIEW"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $student  = Student::find($id);
        $colleges = College::all();
        return view('pages.students.form', [
            'student'           => $student,
            "colleges"          => $colleges,
            "yearLevels"        => $this->yearLevels,
            "genders"           => $this->genders,
            "civilStatusList"   => $this->civilStatusList,
            "illnessStatusList" => $this->illnessStatusList,
            'mode'              => "EDIT"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $student = Student::find($id);

        if (!$student) {
            return response("Student not found", 404);
        }

        try {
            $requestAssoc = $request->toArray();
            $student->fill($requestAssoc);
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }

        try {
            DB::beginTransaction();
            $student->save();
            ActivityLog::insert([
                "logdesc" => "Updated student {$student->SN}",
                "loguser" => Auth::user()->userid
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
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
