<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;

class CategoryController extends Controller
{
    public function index()
    {
        return view('tenant.category');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return response()->json(['msg' => 'User Added Successfully', 'sts' => 'success']);
    }

    public function edit($id)
    {
        return Category::whereId(Crypt::decrypt($id))->first();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Category::findOrFail(Crypt::decrypt($id))->update([
            'name' => $request->name,
        ]);
        return response()->json(['msg' => 'User Updated Successfully', 'sts' => 'success']);
    }

    public function show()
    {
        $data = Category::get();
        $services = Service::get();
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $btn = "";
                $btn .= '<button class="edit btn btn-sm ripple btn-outline-warning" id="' . Crypt::encrypt($row->id) . '">
                            <i class="fe fe-edit-2"></i>
                        </button>

                        <button class="delete btn btn-sm ripple btn-outline-danger" id="' . Crypt::encrypt($row->id) . '">
                            <i class="fe fe-trash"></i>
                        </button>
                        
                        <button class="service-view btn btn-sm ripple btn-outline-warning" id="row_' . $row->id . '" data-class="hide">
                            <i class="fe fe-plus"></i>
                        </button>
                        
                        <button class="addOptions btn btn-sm ripple btn-outline-warning" id="' . Crypt::encrypt($row->id) . '" data-class="hide">
                            Add New Service
                        </button>';

                return $btn;
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->with('services', $services)
            ->make(true);
    }

    public function destroy($id)
    {
        Category::findOrFail(Crypt::decrypt($id))->delete();
        return response()->json(['msg' => 'User Updated Successfully', 'sts' => 'success']);
    }
}
