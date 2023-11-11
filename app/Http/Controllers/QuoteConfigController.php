<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Category;
use App\Models\QuoteConfig;
use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Crypt;

class QuoteConfigController extends Controller
{
    public function config()
    {
        return view('tenant.quote_config');
    }

    public function index()
    {
        $categories = Category::has('services')->get();

        return view('tenant.quote_generator', compact('categories'));
    }

    public function service(Request $request, $id)
    {
        $term = $request->term;
        return Service::when($term, function ($query) use ($term) {
            $query->where('name', 'LIKE', '%' . $term . '%');
        })->where('category_id', $id)->get();
    }

    public function parameters($id)
    {
        $configs = QuoteConfig::with('option.option_values', 'category')
            ->where('service_id', $id)
            ->orderBy('sort_no', 'ASC')->get();


        $html = "";
        if (count($configs) > 0) {

            if ($configs[0]->category->name == 'Automotive') {
                $html .= '<div class="col-sm-6">
                            <div class="form-group">
                                <label class="text-muted" for="make">Make</label>
                                <select name="make" id="make_id" class="form-control form-control-c">
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="text-muted" for="model">Model</label>
                                <select name="model" id="model_id" class="form-control form-control-c">
                                </select>
                            </div>
                        </div>';
            }

            foreach ($configs as $x => $item) {
                if ($item->option->type == 'input') {
                    $html .= '  <div class="col-lg-' . $item->width . ' col-md-' . $item->width . ' col-sm-12 form-group">
                                <label for="' . $item->option->slug . '">' . $item->option->name . '</label>
                                <input class="form-control form-control-c" id="' . $item->option->slug . '">
                            </div>';
                } elseif ($item->option->type == 'select') {
                    $opts = "<option value=''>~~ SELECT ~~</option>";
                    foreach ($item->option->option_values as $tt => $values) {
                        $opts .= '<option value="' . $values->id . '">' . $values->name . '</option>';
                    }
                    $html .= '  <div class="col-lg-' . $item->width . ' col-md-' . $item->width . ' col-sm-12 form-group">
                                <label for="' . $item->option->slug . '">' . $item->option->name . '</label>
                                <select class="form-control customSelect form-control-c" data-name1="' . $item->option->name . '" 
                                data-slug="' . $item->option->slug . '"
                                data-effect="' . $item->option->operator . '"
                                id="' . $item->option->slug . '"
                                >' . $opts . '</select>
                            </div>';
                } elseif ($item->option->type == 'radio') {
                    $optss = '<div class="col-lg-' . $item->width . ' col-md-' . $item->width . ' col-sm-12 form-group">
                                <strong class="d-flex justify-content-center">' . $item->option->name . '</strong><br>
                                <div class="d-flex justify-content-evenly">';
                    foreach ($item->option->option_values as $tt => $values) {
                        $optss .= '<label for="' . $item->option->slug . $values->id . '" class="custom-control custom-radio custom-control-md">
                                    <input type="radio" class="custom-control-input" name="example-radios1" value="' . $values->id . '" id="' . $item->option->slug . $values->id . '">
                                    <span class="custom-control-label custom-control-label-md  tx-16">' . $values->name . '</span>
                                </label>';
                    }

                    $html .= $optss . "</div></div>";
                } elseif ($item->option->type == 'switch') {
                    $html .= '  <div class="col-lg-' . $item->width . ' col-md-' . $item->width . ' col-sm-12 mt-3 mb-2 ml-2 mr-2">
                                <div class="form-group d-flex justify-content-between align-content-center p-2">
                                    <label for="' . $item->option->slug . '">' . $item->option->name . '</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input switch-c" type="checkbox" id="' . $item->option->slug . '" name="comfort_access[0]" value="1">
                                    </div>
                                </div> 
                                </div>';
                }
            }
        }
        return $html;
    }

    public function category(Request $request)
    {
        $term = $request->term;
        return Category::with('services')
            ->has('services')
            ->when($term, function ($query) use ($term) {
                $query->where('name', 'LIKE', '%' . $term . '%')
                    ->orWhereHas('services', function ($query) use ($term) {
                        $query->where('name', 'LIKE', '%' . $term . '%');
                    });
            })
            ->get();
    }

    public function fields(Request $request)
    {
        $term = $request->term;
        return Option::with('option_values')->when($term, function ($row) use ($term) {
            $row->where('name', 'LIKE', '%' . $term . '%');
        })->get();
    }

    public function load()
    {
        $data = QuoteConfig::with(['service', 'category'])->groupBy('service_id')->get();
        $models = QuoteConfig::with('option')->get();
        return Datatables::of($data)
            ->editColumn('service_id', function ($row) {
                if (!empty($row->service)) {
                    return $row->service->name;
                } else {
                    return 'N/A';
                }
            })
            ->editColumn('category_id', function ($row) {
                if (!empty($row->category)) {
                    return $row->category->name;
                } else {
                    return 'N/A';
                }
            })
            ->addColumn('action', function ($row) {
                $btn = "";
                $btn .= '<button class="edit btn btn-sm ripple btn-outline-warning" id="' . Crypt::encrypt($row->service_id) . '">
                            <i class="fe fe-edit-2"></i>
                        </button>

                        <button class="delete btn btn-sm ripple btn-outline-danger" id="' . Crypt::encrypt($row->service_id) . '">
                            <i class="fe fe-trash"></i>
                        </button>

                        <button class="show-models btn btn-sm ripple btn-outline-info" 
                        id="row_' . $row->service_id . '" data-class="hide">
                            <i class="fe fe-plus"></i>
                        </button>';
                return $btn;
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->with('models', $models)
            ->make(true);
    }

    public function create(Request $request)
    {
        // return $request->width;
        $request->validate([
            'service_id' => 'required',
        ]);

        $service_id = $request->service_id;
        $option_id = $request->option_id;
        $width = $request->width;
        $quote_config_id = $request->quote_config_id;

        $data = QuoteConfig::where('service_id', $service_id)->orderBy('id', 'desc')->first();
        $latestSortNo = ($data) ? $data->sort_no : 0;

        $xx = 0;
        foreach ($option_id as $x => $option) {
            $latestSortNo++;

            if (is_null($quote_config_id[$xx])) {
                QuoteConfig::create([
                    'service_id' => $service_id,
                    'option_id' => $option,
                    'sort_no' => $latestSortNo,
                    'width' => $width[$xx],
                ]);
            } else {
                QuoteConfig::whereId($quote_config_id[$xx])->update([
                    'service_id' => $service_id,
                    'option_id' => $option,
                    'sort_no' => $latestSortNo,
                    'width' => $width[$xx],
                ]);
            }
            $xx++;
        }

        QuoteConfig::where('service_id', $service_id)->whereNotIn('option_id', $option_id)->delete();
        return response()->json(['msg' => 'Quote Config Added Successfully', 'sts' => 'success']);
    }

    public function delete_config($id)
    {
        QuoteConfig::findOrFail($id)->delete();
        return response()->json(['msg' => 'Quote Config ID Deleted Successfully', 'sts' => 'success']);
    }

    public function edit($id)
    {
        try {
            return QuoteConfig::with(['service', 'option'])->where('service_id', Crypt::decrypt($id))->get();
        } catch (\Throwable $th) {
            return QuoteConfig::with(['service', 'option'])->where('service_id', $id)->get();
        }
    }

    public function destroy($id)
    {
        QuoteConfig::whereId("service_id", Crypt::decrypt($id))->delete();
        return response()->json(['msg' => 'Quote Config Deleted Successfully', 'sts' => 'error']);
    }
}
