<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    public function index()
    {
        return view('tenant.users');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'user_email' => 'required|email|unique:users,email', // Unique email validation rule
            'user_password' => 'required|min:8|alpha_num', // Password rule: at least 8 characters and alpha-numeric
            'role_id' => 'required',
            'status' => 'required',
        ]);

        $user = User::create([
            'name' => $request->user_name,
            'email' => $request->user_email,
            'password' => $request->user_password,
            'role_id' => $request->role_id,
            'status' => $request->status,
        ]);
        $user->syncRoles([$request->role_id]);

        return response()->json(['msg' => 'User Added Successfully', 'sts' => 'success']);
    }

    public function edit($id)
    {
        return User::with('roles')->whereId(Crypt::decrypt($id))->first();
    }

    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $rules = [
            'user_name' => 'required',
            'user_email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'required',
            'status' => 'required',
        ];

        if ($request->has('user_password') && $request->user_password != "") {
            $rules['user_password'] = 'required|min:8|alpha_num';
        }

        $request->validate($rules);

        $data = [
            'name' => $request->user_name,
            'email' => $request->user_email,
            'status' => $request->status,
            'role_id' => $request->role_id,
        ];
        User::findOrFail($id)->update($data);

        if ($request->has('user_password') && $request->user_password != "") {
            User::findOrFail($id)->update(['password' => $request->user_password]);
        }

        User::findOrFail($id)->syncRoles([$request->role_id]);
        return response()->json(['msg' => 'User Updated Successfully', 'sts' => 'success']);
    }

    public function show()
    {
        $data = User::get();
        return Datatables::of($data)
            ->addColumn('status', function ($row) {
                return $row->status == 'active' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('action', function ($row) {
                $btn = "";
                $btn .= '<button class="edit btn btn-sm ripple btn-outline-warning" id="' . Crypt::encrypt($row->id) . '">
                            <i class="fe fe-edit-2"></i>
                        </button>

                        <button class="delete btn btn-sm ripple btn-outline-danger" id="' . Crypt::encrypt($row->id) . '">
                            <i class="fe fe-trash"></i>
                        </button>';

                return $btn;
            })
            ->addColumn('role_id', function ($row) {
                return '<span class="badge bg-dark">' . $row->role->name . '</span>';
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'status', 'role_id'])
            ->make(true);
    }

    public function destroy($id)
    {
        User::findOrFail(Crypt::decrypt($id))->delete();
        return response()->json(['msg' => 'User Deleted Successfully', 'sts' => 'success']);
    }

    public function logs()
    {
        $data = Activity::orderBy('id', 'desc')->get();
        return Datatables::of($data)
            ->editColumn('causer_id', function ($row) {
                try {
                    return User::findOrFail($row->causer_id)->name;
                } catch (\Throwable $th) {
                    return "N/A";
                }
            })
            ->editColumn('log_name', function ($row) {
                if ($row->log_name == 'default') {
                    return $row->description;
                } else {
                    return $row->log_name;
                }
                return $row->created_at->diffForHumans();
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->make(true);
    }

    public function showLog()
    {
        return view('tenant.activity_logs');
    }
}
