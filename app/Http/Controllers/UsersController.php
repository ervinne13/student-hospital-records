<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SHR\Models\User;
use SHR\Models\UserType;
use Yajra\Datatables\Datatables;

class UsersController extends Controller {

    public function index() {
        return view('pages.users.index');
    }

    public function datatable() {
        return Datatables::of(User::datatable())->make(true);
    }

    public function changePassword() {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $user      = new User();
        $userTypes = UserType::all();
        return view('pages.users.form', ["user" => $user, "mode" => "ADD", "userTypes" => $userTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {

        $currentUser    = Auth::user();
        $hashedPassword = \Hash::make($request->new_password);

        try {
            DB::statement('CALL SP_RegisterUserAccount(?, ?, ?, ?, ?, ?, ?, ?, ?);', [
                $request->username,
                $request->complete_name,
                $request->usertype,
                $request->physician_license_no,
                $currentUser->userid,
                $request->new_password,
                $request->new_password_repeat,
                $hashedPassword,
                Auth::user()->userid
            ]);
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
        $user      = User::find($id);
        $userTypes = UserType::all();
        return view('pages.users.form', ["user" => $user, "mode" => "VIEW", "userTypes" => $userTypes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($userid) {

        $user      = User::find($userid);
        $userTypes = UserType::all();
        return view('pages.users.form', ["user" => $user, "mode" => "EDIT", "userTypes" => $userTypes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $userid) {

        $user = User::find($userid);

        if (!$user) {
            return response("User not found", 404);
        }

        if (($request->new_password || $request->new_password_repeat) && ($request->new_password != $request->new_password_repeat)) {
            return response("Passwords do not match", 400);
        }

        if ($request->new_password && $request->new_password_repeat) {
            if (\Hash::check($request->password, $user->password)) {

                try {
                    DB::beginTransaction();
                    $user->fill($request->toArray());
                    $user->save();
                    ActivityLog::insert([
                        "logdesc" => "Updated user {$user->userid}",
                        "loguser" => Auth::user()->userid
                    ]);
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollBack();
                    return response($e->getMessage(), 500);
                }

                return $user;
            } else {
                return response("Incorrect Password", 400);
            }
        } else {
            $updates = $request->toArray();
            unset($updates["password"]);

            try {
                DB::beginTransaction();
                $user->fill($request->toArray());
                $user->save();
                ActivityLog::insert([
                    "logdesc" => "Updated user {$user->userid}",
                    "loguser" => Auth::user()->userid
                ]);
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return response($e->getMessage(), 500);
            }

            return $user;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        try {
            $user = User::find($id);
            $user->delete();
        } catch (\Exception $e) {
//            return response($e->getMessage(), 500);
            return response("Unable to delete user, it might already be used in other related data. For data integrity protection, deletion is prohibited.", 500);
        }
    }

}
