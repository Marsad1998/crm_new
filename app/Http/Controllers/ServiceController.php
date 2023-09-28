<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;

class ServiceController extends Controller
{
    public function services(Request $request, $id)
    {
        $request->validate([
            'service_name' => 'required',
        ]);

        Service::create([
            'name' => $request->service_name,
            'category_id' => Crypt::decrypt($id)
        ]);
        return response()->json(['msg' => 'Service added Successfully', 'sts' => 'success']);
    }

    public function modify(Request $request)
    {
        $id = substr(base64_decode($request->id), 5, -5);
        if ($request->type == 'delete') {
            Service::findOrFail($id)->delete();
            return response()->json(['msg' => 'Service Deleted', 'sts' => 'success']);
        } else {
            return Service::with('category')->findOrFail($id);
        }
    }

    public function update(Request $request, $service_id)
    {
        $request->validate([
            'service_name' => 'required',
        ]);
        $service_id = substr(base64_decode($service_id), 5, -5);
        Service::findOrFail($service_id)->update([
            'name' => $request->service_name,
        ]);

        return response()->json(['msg' => 'Service Updated Successfully', 'sts' => 'success']);
    }

    public function show()
    {
        $data = Service::get();
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $btn = "";
                $btn .= '<button class="edit btn btn-sm ripple btn-outline-warning" id="services/' . Crypt::encrypt($row->id) . '">
                            <i class="fe fe-edit-2"></i>
                        </button>

                        <button class="delete btn btn-sm ripple btn-outline-danger" data-tbl="services" id="services/' . Crypt::encrypt($row->id) . '">
                            <i class="fe fe-trash"></i>
                        </button>';

                return $btn;
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'type'])
            ->make(true);
    }
}
