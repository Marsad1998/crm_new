<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;

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
        ]);

        User::create([
            'name' => $request->make_name
        ]);

        return response()->json(['msg' => 'Make Added Successfully', 'sts' => 'success']);
    }

    public function show()
    {
        $data = User::get();
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $btn = "";
                $btn .= '<button class="edit btn btn-sm ripple btn-outline-warning" id="users/' . Crypt::encrypt($row->id) . '">
                            <i class="fe fe-edit-2"></i>
                        </button>

                        <button class="delete btn btn-sm ripple btn-outline-danger" data-tbl="users" id="users/' . Crypt::encrypt($row->id) . '">
                            <i class="fe fe-trash"></i>
                        </button>';

                return $btn;
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}
