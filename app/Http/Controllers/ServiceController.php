<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;

class ServiceController extends Controller
{
    public function index()
    {
        return view('tenant.services');
    }

    public function show()
    {
        $data = Service::get();
        return Datatables::of($data)
            ->editColumn('type', function ($row) {
                if ($row->type == 'regular') {
                    return '<span class="badge bg-info">Regular</span>';
                } else if ($row->type == 'flat_rate') {
                    return '<span class="badge bg-primary">Flat Rate</span>';
                } else if ($row->type == 'option_based') {
                    return '<span class="badge text-white bg-warning">Option Based</span>';
                }
            })
            ->editColumn('price', function ($row) {
                return "$" . number_format($row->price, 2);
            })
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
