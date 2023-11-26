<?php

namespace App\Http\Controllers;

use App\Models\BulkDiscount;
use App\Models\Makes;
use App\Models\Models;
use App\Models\Option;
use App\Models\Service;
use App\Models\OptionValue;
use Illuminate\Support\Str;
use App\Models\PriceManager;
use Illuminate\Http\Request;
use League\Flysystem\Visibility;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class PriceManagerController extends Controller
{
    public function index()
    {

        $makes = Makes::get();
        $services = Service::get();
        $keyType = OptionValue::where("option_id", 4)->get();
        $bulkDiscounts = BulkDiscount::with("KeyType")->get();

        //        dd($bulkDiscounts);

        return view('tenant.price', compact('makes', 'services', 'keyType', 'bulkDiscounts'));
    }

    public function makes(Request $request)
    {
        $term = $request->term;
        return Makes::when($term, function ($row) use ($term) {
            $row->where('name', 'LIKE', '%' . $term . '%');
        })->get();
    }

    public function getModel(Request $request)
    {
        $models = Models::where("make_id", $request->make_id)->get();
        return view('tenant.makenmodel.ajax.model-option', compact('models'))->render();
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

    public function paste(Request $request)
    {
        $lines = explode("\n", $request->data);

        $carData = [];

        foreach ($lines as $line) {
            $carInfo = explode(' ', $line);
            // key innovations = Done
            if (count($carInfo) == 3) {
                $yearRange = explode('-', $carInfo[0]);
                if (count($yearRange) > 1) {
                    $yearFrom = $yearRange[0];
                    $yearTo = $yearRange[1];
                    $brand = $carInfo[1];
                    $modelName = $carInfo[2];
                } else {
                    // American Supply = Done
                    $brand = $carInfo[0];
                    $modelName = $carInfo[1];
                    $yearRange = explode('-', $carInfo[2]);
                    $yearFrom = $yearRange[0];
                    $yearTo = $yearRange[1];
                }
            }
            // UHS = Done
            elseif (count($carInfo) == 5) {
                $yearFrom = $carInfo[0];
                $yearTo = $carInfo[2];
                $brand = $carInfo[3];
                $modelName = $carInfo[4];
            } elseif (count($carInfo) == 6) {
                $yearFrom = $carInfo[0];
                $yearTo = $carInfo[2];
                $brand = $carInfo[3];
                $modelName = $carInfo[4] . " " . $carInfo[5];
            }

            $carData[] = [
                'brand' => $brand,
                'model' => $modelName,
                'year_from' => $yearFrom,
                'year_to' => $yearTo,
            ];
        }

        foreach ($carData as $x => $value) {
            // Check if the make and model prices exist
            $makePrice = PriceManager::with('makes')
                ->whereHas('makes', function ($row) use ($value) {
                    $row->where('makes.name', $value['brand'])
                        ->orWhere('makes.name', 'LIKE', '%' . $value['brand'] . '%');
                })->first();

            $modelPrice = PriceManager::with('models')
                ->whereHas('makes', function ($row) use ($value) {
                    $row->where('makes.name', $value['brand'])
                        ->orWhere('makes.name', 'LIKE', '%' . $value['brand'] . '%');
                })
                ->whereHas('models', function ($row) use ($value) {
                    $row->where('models.name', $value['model'])
                        ->orWhere('models.name', 'LIKE', '%' . $value['model'] . '%');
                })->first();


            // Check if the make and model exist in the Makes and Models tables
            $makeMatched = Makes::where('name', $value['brand'])
                ->orWhere('name', 'LIKE', '%' . $value['brand'] . '%')
                ->first();

            $modelMatched = Models::with('make')
                ->where('name', $value['model'])
                ->whereHas('make', function ($subQuery) use ($value) {
                    $subQuery->where('name', $value['brand'])
                        ->orWhere('name', 'LIKE', '%' . $value['brand'] . '%');
                })
                ->first();


            if (!is_null($makePrice) && !is_null($modelPrice)) {
                // Both make and model matched in PriceManager
                $carData[$x]['match_type'] = 'both';
                $carData[$x]['make_id'] = $makePrice->makes->id;
                $carData[$x]['model_id'] = $modelPrice->models->id;
            } elseif (!is_null($makeMatched) && !is_null($modelMatched)) {
                // Both make and model exist in Makes and Models tables
                if (!is_null($makePrice) && !is_null($modelPrice)) {
                    $carData[$x]['match_type'] = 'both_with_price';
                    $carData[$x]['make_id'] = $makeMatched->id;
                    $carData[$x]['model_id'] = $modelMatched->id;
                } else {
                    $carData[$x]['match_type'] = 'both_without_price';
                    $carData[$x]['make_id'] = $makeMatched->id;
                    $carData[$x]['model_id'] = $modelMatched->id;
                }
            } elseif (!is_null($makePrice)) {
                // Only make matched in PriceManager
                $carData[$x]['match_type'] = 'makes';
                $carData[$x]['make_id'] = $makePrice->makes->id;
            } elseif (!is_null($makeMatched)) {
                // Only make matched in Makes table
                $carData[$x]['match_type'] = 'makes_without_price';
                $carData[$x]['make_id'] = $makeMatched->id;
            } else {
                // No match
                $carData[$x]['match_type'] = 'none';
            }
        }

        return $carData;
    }

    public function create(Request $request)
    {
        $make_id = $request->make_id;
        $service_id = $request->service_id;
        // foreach ($make_id as $x => $value) {
        for ($x = 0; $x < count($make_id); $x++) {
            $model_name = $request->model_name[$x] ?? null;
            $make_name = $request->make_name[$x] ?? null;
            $model_id = ($request->model_id)[$x] ?? null;

            if ($make_id[$x] == 'new' && $model_id == 'new' && $make_id[$x] != null && $model_id != null) {
                $makeExist = Models::where('name', $make_name)
                    ->orWhere('name', 'LIKE', '%' . $make_name . '%')->first();
                if (is_null($makeExist)) {
                    $mak = Makes::create([
                        'name' => $make_name,
                    ]);
                    $mod = Models::create(['make_id' => $mak->id, 'name' => $model_name])->id;
                } else {
                    $mod = Models::create(['make_id' => $makeExist->id, 'name' => $model_name])->id;
                }
            } elseif ($model_id == 'new' && $model_id != null) {
                $modelExist = Models::with('make')
                    ->where('name', $model_name)
                    ->where('make_id', $make_id[$x])
                    ->first();

                if (is_null($modelExist)) {
                    $mod = Models::create(['make_id' => $make_id[$x], 'name' => $model_name])->id;
                } else {
                    $mod = $modelExist->id;
                }
            } else {
                $mod = $model_id;
            }

            foreach ($service_id as $y => $value1) {
                $file = $request->file('file')[$y];

                try {
                    $filename = uniqid(rand()) . "." . $file->getClientOriginalExtension();
                    Storage::put('/', $file, $filename);
                    $path =  "tenants/tenant" . tenant('id') . '/app/' . $filename;
                } catch (\Throwable $th) {
                    Log::alert($th);
                }

                // $filename = uniqid(rand()) . "." . $file->getClientOriginalExtension();
                // $path = "tenants/tenant" . tenant('id') . '/app/' . $filename;
                // Storage::put($path, $file, Visibility::PUBLIC);

                // try {
                //     $filename = uniqid(rand()) . "." . $file->getClientOriginalExtension();
                //     $path = "assets/";
                //     $file->move("tenants/tenant" . tenant('id') . '/app/', $filename);
                // } catch (\Throwable $th) {
                //     Log::alert($th);
                // }

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

                $comfort_access = isset($request->comfort_access[$y]) ? $request->comfort_access[$y] : 1;
                $akl = isset($request->akl[$y]) ? $request->akl[$y] : 1;

                $exist = PriceManager::where('model_id', $mod)
                    ->where('service_id', $value1)
                    ->where('key_type_id', ($request->key_type)[$y])
                    ->where('pts', $comfort_access)
                    ->where('oem', ($request->key_manu)[$y])
                    ->where('akl', $akl)
                    ->first();
                // if already exist
                if (!is_null($exist)) {
                    PriceManager::whereId($exist->id)->update($data);
                } else {
                    PriceManager::create($data);
                }
            }
        }
        // }

        return response()->json(['msg' => 'Price Added Successfully', 'sts' => 'success']);
    }

    public function show(Request $request)
    {
        $data = ($request->data);
        $query = PriceManager::query();
        if (isset($data['price'])) {
            $price = explode("-", $data['price']);
            $min = trim(str_replace("$", "", $price[0]));
            $max = trim(str_replace("$", "", $price[1]));

            $query->where("amount", ">=", $min)->where("amount", "<=", $max);
        }
        if (isset($data['modelValue'])) {
            $query->where("model_id", $data['modelValue']);
        }
        if (isset($data['yearValue'])) {
            $query->where("year_start", '>=', $data['yearValue']);
        }
        if (isset($data['serviceValue'])) {
            $query->where("year_start", ">=", $data['serviceValue']);
        }
        if (isset($data['key_typeValue'])) {
            $query->where("key_type_id",  $data['key_typeValue']);
        }
        if (isset($data['hasNotes'])) {
            if (isset($data['hasNotes']) == 1) {
                $query->whereNotNull("PN");
            }
            if (isset($data['hasNotes']) == 2) {
                $query->whereNull("PN");
            }
        }
        if (isset($data['hasImages'])) {
            if (isset($data['hasImages']) == 1) {
                $query->whereNotNull("image");
            }
            if (isset($data['hasImages']) == 2) {
                $query->whereNull("image");
            }
        }
        if (isset($data['manufacturer'])) {
            $oem = explode("|", $data['manufacturer']);
            $query->where(function ($query) use ($oem) {
                if (in_array("1", $oem)) {
                    $query->orWhere("oem", 1);
                }
                if (in_array("2", $oem)) {
                    $query->orWhere("oem", 0);
                }
                if (in_array("null", $oem)) {
                    $query->orWhereNull("oem");
                }
            });
        }
        if (isset($data['akl'])) {
            $akl = explode("|", $data['akl']);
            $query->where(function ($query) use ($akl) {
                if (in_array("1", $akl)) {
                    $query->orWhere("akl", 1);
                }
                if (in_array("2", $akl)) {
                    $query->orWhere("akl", 0);
                }
                if (in_array("null", $akl)) {
                    $query->orWhereNull("akl");
                }
            });
        }
        if (isset($data['comfortAccess'])) {
            $comfortAccess = explode("|", $data['comfortAccess']);
            $query->where(function ($query) use ($comfortAccess) {
                if (in_array("1", $comfortAccess)) {
                    $query->orWhere("comfort_access", 1);
                }
                if (in_array("2", $comfortAccess)) {
                    $query->orWhere("comfort_access", 0);
                }
                if (in_array("null", $comfortAccess)) {
                    $query->orWhereNull("comfort_access");
                }
            });
        }

        $data = $query->with(['models', 'makes'])->limit(100)->orderBy('id', 'DESC')->get();
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
            ->editColumn('PN', function ($row) {
                return '<a title="' . $row->PN . '">' . Str::limit($row->PN, 15) . '</a>';
            })
            ->addColumn('image', function ($row) {
                return '<div class="icon-container">
                                <img src="' . global_asset($row->image) . '">
                                <div class="hover-info">
                                    <img src="' . global_asset($row->image) . '">
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
            ->rawColumns(['action', 'comfort_access', 'manufacturer', 'akl', 'image', 'PN'])
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
                    $file->move("tenants/tenant" . tenant('id') . '/app/', $filename);
                    $path =  "tenants/tenant" . tenant('id') . '/app/' . $filename;
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
