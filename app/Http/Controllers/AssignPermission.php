<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class AssignPermission extends Controller
{
    public function index()
    {
        return view('tenant.assign_permission');
    }

    public function create(Request $request)
    {
        $collection = collect($request->permission);
        $role = Role::find($request->role_id);
        $role->syncPermissions($collection);
        activity()
            ->performedOn($role)
            ->causedBy(Auth::user()->id)
            ->event('Modified')
            ->log('Permission');
        return response()->json(['msg' => 'Permission Assigned Successfully', 'sts' => 'success']);
    }

    public function show()
    {
        $user = Permission::all();
        return Datatables::of($user)
            ->addColumn('action', function ($row) {
                return '<input type="checkbox" class="permission" id="permission_' . $row->id . '" value="' . $row->id . '">';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function edit($role_id)
    {
        $role = Role::findOrFail($role_id);
        return $role->getAllPermissions();
    }
}
