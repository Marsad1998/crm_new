<?php

namespace App\Http\Controllers;

use App\Models\Makes;
use App\Models\Models;
use App\Models\Service;
use App\Models\OptionValue;
use App\Models\PriceManager;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;

class PriceManagerController extends Controller
{
    public function index()
    {
        return view('tenant.price');
    }

    public function makes(Request $request)
    {
        $term = $request->term;
        return Makes::when($term, function ($row) use ($term) {
            $row->where('name', 'LIKE', '%' . $term . '%');
        })->get();
    }

    public function models(Request $request, $id)
    {
        $term = $request->term;
        return Models::where('make_id', $id)->when($term, function ($row) use ($term) {
            $row->where('name', 'LIKE', '%' . $term . '%');
        })->get();
    }

    public function services(Request $request)
    {
        $term = $request->term;
        return Service::with('category')->when($term, function ($row) use ($term) {
            $row->where('name', 'LIKE', '%' . $term . '%');
        })->whereHas('category', function ($row) {
            $row->where('name', 'Automotive');
        })->get();
    }

    public function key_type(Request $request)
    {
        $term = $request->term;
        return OptionValue::when($term, function ($row) use ($term) {
            $row->where('name', 'LIKE', '%' . $term . '%');
        })->whereHas('option', function ($row) {
            $row->where('slug', 'type-of-key');
        })->get();
    }

    public function create(Request $request)
    {
        $make_id = $request->make_id;
        $service_id = $request->service_id;

        foreach ($make_id as $x => $value) {

            $model_name = $request->model_name[$x] ?? null;
            $make_name = $request->make_name[$x] ?? null;
            $model_id = ($request->model_id)[$x] ?? null;

            if ($value == 'new' && $model_id == 'new' && $value != null && $model_id != null) {
                $mak = Makes::create([
                    'name' => $make_name,
                ]);

                $mod = Models::create(['make_id' => $mak->id, 'name' => $model_name])->id;
            } elseif ($model_id == 'new' && $model_id != null) {
                $mod = Models::create(['make_id' => $value, 'name' => $model_name])->id;
            } else {
                $mod = $model_id;
            }

            foreach ($service_id as $y => $value1) {

                $file = $request->file('file')[$y];

                $filename = uniqid(rand()) . "." . $file->getClientOriginalExtension();
                $file->storeAs('/', $filename, 'local');
                $path = global_asset('tenants/') . "/tenant" . tenant('id') . '/app/' . $filename;

                $data = [
                    'model_id' => $mod,
                    'year_start' => ($request->year_from)[$x] ?? null,
                    'year_end' => ($request->year_to)[$x] ?? null,
                    'service_id' => $value1,
                    'key_type_id' => ($request->key_type)[$y] ?? null,
                    'PN' => ($request->notes)[$y] ?? null,
                    'pts' => ($request->comfort_access)[$y] ?? null,
                    'oem' => ($request->key_manu)[$y] ?? null,
                    'akl' => ($request->akl)[$y] ?? null,
                    'amount' => ($request->amount)[$y] ?? null,
                    'image' => $path,
                ];

                PriceManager::create($data);
            }
        }
        return response()->json(['msg' => 'Price Added Successfully', 'sts' => 'success']);
    }

    public function show()
    {
        $data = PriceManager::with(['models', 'makes'])->get();
        return Datatables::of($data)
            ->addColumn('model_id', function ($row) {
                return !is_null($row->models) ? $row->models->name : 'N/A';
            })
            ->addColumn('make_id', function ($row) {
                return !is_null($row->makes) ? $row->makes->name : 'N/A';
            })
            ->addColumn('service_id', function ($row) {
                return !is_null($row->services) ? $row->services->name : 'N/A';
            })
            ->addColumn('key_type_id', function ($row) {
                return !is_null($row->keys) ? $row->keys->name : 'N/A';
            })
            ->addColumn('comfort_access', function ($row) {
                return $row->pts == 1 ? '<span class="badge bg-info-light text-info">Yes</span>' : '<span class="badge bg-danger-light text-danger">N/A</span>';
            })
            ->addColumn('manufacturer', function ($row) {
                return $row->oem == 1 ? '<span class="badge bg-primary-light text-primary">OEM</span>' : '<span class="badge bg-warning-light text-warning">After Market</span>';
            })
            ->addColumn('akl', function ($row) {
                return $row->akl == 1 ? '<span class="badge bg-success-light text-success">Yes</span>' : '<span class="badge bg-danger-light text-danger">No</span>';
            })
            ->addColumn('image', function ($row) {
                // $filename = global_asset('tenants/') . "/tenant" . tenant('id') . '/app/' . $row->image;
                return '<div class="icon-container">
                                <img src="' . $row->image . '">
                                <div class="hover-info">
                                    <img src="' . $row->image . '">
                                </div>
                            </div>';
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
            ->addIndexColumn()
            ->rawColumns(['action', 'comfort_access', 'manufacturer', 'akl', 'image'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return PriceManager::with(['services', 'models', 'makes', 'keys'])->where('id', Crypt::decrypt($id))->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $make_id = $request->make_id;
        $service_id = $request->service_id;

        foreach ($make_id as $x => $value) {

            $model_name = $request->model_name[$x] ?? null;
            $make_name = $request->make_name[$x] ?? null;
            $model_id = ($request->model_id)[$x] ?? null;

            if ($value == 'new' && $model_id == 'new' && $value != null && $model_id != null) {
                $mak = Makes::create([
                    'name' => $make_name,
                ]);

                $mod = Models::create(['make_id' => $mak->id, 'name' => $model_name])->id;
            } elseif ($model_id == 'new' && $model_id != null) {
                $mod = Models::create(['make_id' => $value, 'name' => $model_name])->id;
            } else {
                $mod = $model_id;
            }

            foreach ($service_id as $y => $value1) {

                $data = [
                    'model_id' => $mod,
                    'year_start' => ($request->year_from)[$x] ?? null,
                    'year_end' => ($request->year_to)[$x] ?? null,
                    'service_id' => $value1,
                    'key_type_id' => ($request->key_type)[$y] ?? null,
                    'PN' => ($request->notes)[$y] ?? null,
                    'pts' => ($request->comfort_access)[$y] ?? null,
                    'oem' => ($request->key_manu)[$y] ?? null,
                    'akl' => ($request->akl)[$y] ?? null,
                    'amount' => ($request->amount)[$y] ?? null,
                ];

                if ($request->has('file')) {
                    $file = $request->file('file')[$y];
                    $filename = uniqid(rand()) . "." . $file->getClientOriginalExtension();
                    $file->storeAs('/', $filename, 'local');
                    $path = global_asset('tenants/') . "/tenant" . tenant('id') . '/app/' . $filename;
                    $data['image'] = $path;
                }

                PriceManager::whereId($id)->update($data);
            }
        }

        return response()->json(['msg' => 'Price Updated Successfully', 'sts' => 'success']);
    }

    public function destroy($id)
    {
        PriceManager::findOrfail(Crypt::decrypt($id))->delete();
        return response()->json(['msg' => 'Price Deleted Successfully', 'sts' => 'success']);
    }
}
