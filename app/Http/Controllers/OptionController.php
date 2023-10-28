<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\OptionValue;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Crypt;

class OptionController extends Controller
{
    public function index()
    {
        return view('tenant.options');
    }

    public function store(Request $request)
    {
        $request->validate([
            'option_name' => 'required',
            'option_type' => 'required',
            'option_category' => 'required',
            'option_operator' => 'required',
        ]);
        Option::create([
            'name' => $request->option_name,
            'type' => $request->option_type,
            'option_category' => $request->option_category,
            'operator' => $request->option_operator,
        ]);
        return response()->json(['msg' => 'Option Saved Successfully', 'sts' => 'success']);
    }

    public function show()
    {
        $option = Option::with('option_values')->get();
        $option_values = OptionValue::all();
        return Datatables::of($option)
            ->addColumn('action', function ($row) {
                $btn = "";
                $btn .= '<button class="edit btn btn-sm btn-outline-info mr-5" id="' . Crypt::encrypt($row->id) . '">
                            <i class="fe fe-edit-2"></i>
                        </button>';

                $btn .= '
                <button class="delete btn btn-sm btn-outline-danger mr-5" id="' . Crypt::encrypt($row->id) . '">
                            <i class="fe fe-trash"></i>
                        </button>
                        ';

                if ($row->type == 'select') {
                    $btn .= '<button class="show-models btn btn-sm btn-outline-info" id="row_' . $row->id . '" data-class="hide">
                                <i class="fe fe-plus"></i>
                            </button>
                            <button class="addSelectOptions btn btn-sm btn-outline-danger mr-5" id="' . Crypt::encrypt($row->id) . '" data-type="' . $row->operator . '">
                                Add Selectable Options
                            </button>';
                } elseif ($row->type == 'radio') {
                    $btn .= '<button class="show-models btn btn-sm btn-outline-info" id="row_' . $row->id . '" data-class="hide">
                                <i class="fe fe-plus"></i>
                            </button>
                            <button class="addSelectOptions btn btn-sm btn-outline-danger mr-5" id="' . Crypt::encrypt($row->id) . '" data-type="' . $row->operator . '">
                                Add Radio Options
                            </button>';
                }
                return $btn;
            })
            ->addColumn('type', function ($row) {
                if ($row->type == 'input') {
                    return '<input readonly class="form-control bd-gray-900 form-control-sm" placeholder="This is Input / Text Field">';
                } elseif ($row->type == 'select') {
                    $options = "";
                    foreach ($row->option_values as $x => $value) {
                        $options .= '<option value="">' . $value->name . '</option>';
                    }
                    return '<select class="form-control form-control-sm bd-gray-900" readonly><option value="">Seletable Option</option>' . $options . '</select>';
                } elseif ($row->type == 'radio') {
                    return '<div class="d-flex justify-content-center"><input type="radio" name="radio"> This is Radio Checkbox</div>';
                } elseif ($row->type == 'switch') {
                    return '<div class="main-toggle on main-toggle-success">
                                <span></span>
                            </div>';
                }
            })
            ->addColumn('option_category', function ($row) {
                if ($row->operator == 'additive') {
                    return $row->option_category . " (+/-)";
                } else if ($row->operator == 'multiplicative') {
                    return $row->option_category . " (%)";
                } else {
                    return $row->option_category . " (No Effect)";
                }
            })
            ->rawColumns(['action', 'type'])
            ->with('option_values', $option_values)
            ->make(true);
    }

    public function edit($id)
    {
        return Option::findOrfail(Crypt::decrypt($id));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'option_name' => 'required',
            'option_type' => 'required',
            'option_category' => 'required',
            'option_operator' => 'required',
        ]);

        Option::findOrfail(Crypt::decrypt($id))->update([
            'name' => $request->option_name,
            'type' => $request->option_type,
            'option_category' => $request->option_category,
            'operator' => $request->option_operator,
        ]);

        return response()->json(['msg' => 'Option Updated Successfully', 'sts' => 'success']);
    }

    public function destroy($id)
    {
        Option::findOrfail(Crypt::decrypt($id))->delete();
        return response()->json(['msg' => 'Option Deleted Successfully', 'sts' => 'error']);
    }
}
