<?php

namespace App\Http\Controllers;

use App\Models\Makes;
use App\Models\Models;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;

class MakesController extends Controller
{
    public function index()
    {
        return view('tenant.makenmodel');
    }

    public function store(Request $request)
    {
        $request->validate([
            'make_name' => 'required'
        ]);
        Makes::create([
            'name' => $request->make_name
        ]);

        return response()->json(['msg' => 'Make Added Successfully', 'sts' => 'success']);
    }

    public function show()
    {
        $data = Makes::select('name', 'id')->get();
        $test = Models::all();
        return Datatables::of($data)
            ->addColumn('type', function () {
                return '<span class="badge bg-light text-primary">Makes</span>';
            })
            ->addColumn('action', function ($row) {
                $btn = "";

                $btn .= '<button class="edit btn btn-sm ripple btn-outline-warning" id="makes/' . Crypt::encrypt($row->id) . '">
                            <i class="fe fe-edit-2"></i>
                        </button>

                        <button class="delete btn btn-sm ripple btn-outline-danger" data-tbl="makenModal" id="makes/' . Crypt::encrypt($row->id) . '">
                            <i class="fe fe-trash"></i>
                        </button>
                        
                        <button class="show-models btn btn-sm ripple btn-outline-info" id="row_' . $row->id . '" data-class="hide">
                            <i class="fe fe-plus"></i>
                        </button>';

                return $btn;
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'type'])
            ->with('models', $test)
            ->make(true);
    }

    public function edit($id)
    {
        return [
            Makes::select('name')->whereId(Crypt::decrypt($id))->first(),
            'makes'
        ];
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'make_name' => 'required'
        ]);

        Makes::findOrFail(Crypt::decrypt($id))->update([
            'name' => $request->make_name
        ]);

        return response()->json(['msg' => 'Make Updated Successfully', 'sts' => 'success']);
    }

    public function destroy($id)
    {
        Makes::findOrFail(Crypt::decrypt($id))->delete();
        return response()->json(['msg' => 'Make Deleted Successfully', 'sts' => 'success']);
    }
}
