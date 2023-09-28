<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    public function index()
    {
        return view('tenant.roles');
    }

    public function create(Request $request)
    {
        Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);
        return response()->json(['msg' => 'User Saved Successfully', 'sts' => 'success']);
    }

    public function show()
    {
        $user = Role::all();
        return Datatables::of($user)
            ->addColumn('action', function ($row) {
                $btn = "";
                $btn .= '<button class="edit btn btn-sm btn-outline-info mr-5" id="' . $row->id . '">
                            <i class="fe fe-edit-2"></i>
                        </button>
                        <button class="delete btn btn-sm btn-outline-danger mr-5" id="' . $row->id . '">
                            <i class="fe fe-trash"></i>
                        </button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function edit($id)
    {
        return Role::findOrfail($id);
    }

    public function update(Request $request, $id)
    {
        $user = Role::findOrfail($id);
        $user->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return response()->json(['msg' => 'User Updated Successfully', 'sts' => 'success']);
    }

    public function destroy($id)
    {
        Role::findOrfail($id)->delete();
        return response()->json(['msg' => 'User Deleted Successfully', 'sts' => 'error']);
    }
}
