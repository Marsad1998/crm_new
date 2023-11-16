<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuoteSearch;
use App\Models\Option;
use App\Models\Category;
use App\Models\OptionValue;
use App\Models\PriceManager;
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
                            <div class="mb-2">
                                <label class="text-muted" for="make">Make</label>
                                <select name="make" id="make_id" class="form-control form-control-c">
                                </select>
                                <span class="error-span text-danger " id="error-make"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-2">
                                <label class="text-muted" for="model">Model</label>
                                <select name="model" id="model_id" class="form-control form-control-c">
                                </select>
                                <span class="error-span text-danger " id="error-model"></span>
                            </div>
                        </div>';
            }

            foreach ($configs as $x => $item) {
                if ($item->option->type == 'input') {
                    $html .= '  <div class="col-lg-' . $item->width . ' col-md-' . $item->width . ' col-sm-12 mb-2">
                                <label for="lb_' . $item->option->slug . '">' . $item->option->name . '</label>
                                <input class="form-control form-control-c" name="options[' . $item->option->slug . ']" id="lb_' . $item->option->slug . '">
                                <span class="error-span text-danger " id="error-' . $item->option->slug . '"></span>
                            </div>';
                } elseif ($item->option->type == 'select') {
                    $opts = "<option value=''>~~ SELECT ~~</option>";
                    foreach ($item->option->option_values as $tt => $values) {
                        $opts .= '<option value="' . $values->id . '">' . $values->name . '</option>';
                    }
                    $html .= '  <div class="col-lg-' . $item->width . ' col-md-' . $item->width . ' col-sm-12 mb-2" id="cus_' . $item->option->slug . '">
                                <label for="lb_' . $item->option->slug . '">' . $item->option->name . '</label>
                                <select class="form-control customSelect form-control-c" 
                                data-name1="' . $item->option->name . '" 
                                data-slug="' . $item->option->slug . '"
                                data-effect="' . $item->option->operator . '"
                                name="options[' . $item->option->slug . ']" id="lb_' . $item->option->slug . '"
                                >' . $opts . '</select>
                                <span class="error-span text-danger " id="error-' . $item->option->slug . '"></span>
                            </div>';
                } elseif ($item->option->type == 'radio') {
                    $optss = '<div class="col-lg-' . $item->width . ' col-md-' . $item->width . ' col-sm-12 mb-2">
                                <strong class="d-flex justify-content-center">' . $item->option->name . '</strong><br>
                                <div class="d-flex justify-content-evenly">';
                    foreach ($item->option->option_values as $tt => $values) {
                        $optss .= '<label for="lb_' . $item->option->slug . $values->id . '" class="custom-control custom-radio custom-control-md">
                                    <input type="radio" class="custom-control-input" value="' . $values->id . '" name="options[' . $item->option->slug . ']" id="lb_' . $item->option->slug . $values->id . '" value="1" required>
                                    <span class="custom-control-label custom-control-label-md  tx-16">' . $values->name . '</span>
                                </label>
                                
                                <span class="error-span text-danger " id="error-' . $item->option->slug . '"></span>';
                    }

                    $html .= $optss . "</div></div>";
                } elseif ($item->option->type == 'switch') {
                    $class = "";
                    if ($item->option->slug == 'is-there-comfort-access') {
                        $class = "d-none";
                    }

                    $action = '';
                    $reaction = '';
                    if ($item->option->slug == 'does-the-vehicle-use-push-to-start-or-knob-turn-to-start') {
                        $action = 'is-there-comfort-access';
                        $reaction = 'type-of-key';
                    }

                    $html .= '  <div class="col-lg-' . $item->width . ' col-md-' . $item->width . ' col-sm-12 mt-3 mb-2 ml-2 mr-2 ' . $class . '" id="cus_' . $item->option->slug . '">
                                <div class="mb-2 d-flex justify-content-between align-content-center p-2">
                                    <label for="lb_' . $item->option->slug . '">' . $item->option->name . '</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input customSwitch switch-c" type="checkbox" name="options[' . $item->option->slug . ']" id="lb_' . $item->option->slug . '" data-action="' . $action . '" data-reaction="' . $reaction . '" value="1">
                                    </div>
                                    <span class="error-span text-danger " id="error-' . $item->option->slug . '"></span>
                                </div>
                                </div>';
                }
            }
        }
        return $html;
    }

    public function search(Request $request)
    {
        $rules = [
            'category' => 'required',
            'service_id' => 'required',
            'make' => 'required',
            'model' => 'required',
            'options' => 'array',
        ];

        $options = $request->input('options');

        foreach ($options as $key => $value) {
            if ($key != 'type-of-key') {
                $rules["options.{$key}"] = ['required']; // Add your specific rules for each dynamic field
            }
        }

        $request->validate($rules);

        $data = $request->options;

        $li = "";
        $effects = OptionValue::with('option')->whereIn('id', $data)->get();
        $ser_pri = [];
        foreach ($effects as $x => $option) {
            if ($option->option->operator == 'additive') {
                $action = '<p class="pt-3 fst-italic d-flex justify-content-center">$' . $option->amount . '</p>';
                $ser_pri[] = [$option->option->operator, $option->amount];
            } else if ($option->option->operator == 'multiplicative') {
                $action = '<p class="pt-3 fst-italic d-flex justify-content-center">Base Cost x ' . $option->amount . '%</p>';
                $ser_pri[] = [$option->option->operator, $option->amount];
            } else {
                $action = "";
            }

            if ($action != "") {
                $li .= '<div class="d-flex justify-content-center servicesEf gen-quo-div" id="quo_div_' . $option->option->id . '" data-operator="' . $option->option->operator . '" data-amount="' . $option->amount . '">
                            <div class="p-2 gen-quo-div-data">
                                <strong><span>' . $option->option->name . '</span>: <span>' . $option->name . '</span></strong><br>
                                ' . $action . '
                            </div>
                            <div class="gen-quo-div-btn">
                                <button class="btn removePrice footer-btn" id="' . $option->option->id . '" data-type="options">Remove</button>
                            </div>
                        </div>';
            }
        }

        return PriceManager::with('makes', 'models')
            ->when(isset($request->model), function ($row) use ($request) {
                $row->where('model_id', $request->model);
            })
            ->when(isset($request->service_id), function ($row) use ($request) {
                $row->where('service_id', $request->service_id);
            })
            ->when(isset($data['type-of-key']), function ($query) use ($data) {
                return $query->where('key_type_id', $data['type-of-key']);
            })
            ->when(isset($data['does-the-vehicle-use-push-to-start-or-knob-turn-to-start']), function ($query) use ($data) {
                return $query->where('pts', $data['does-the-vehicle-use-push-to-start-or-knob-turn-to-start']);
            })
            ->when(isset($data['is-there-comfort-access']), function ($query) use ($data) {
                return $query->where('oem', $data['is-there-comfort-access']);
            })
            ->when(isset($data['has-the-customer-lost-all-the-spare-keys']), function ($query) use ($data) {
                return $query->where('akl', $data['has-the-customer-lost-all-the-spare-keys']);
            })
            ->when(isset($data['year']), function ($row) use ($data) {
                $row->where(function ($query) use ($data) {
                    $query->where('year_start', $data['year'])
                        ->orWhere(function ($query) use ($data) {
                            $query->where('year_start', '<=', $data['year'])
                                ->where('year_end', '>=', $data['year']);
                        });
                });
            })
            ->get()
            ->map(function ($row) use ($data, $li, $ser_pri) {
                if (!empty($row->makes) && !empty($row->models)) {

                    return [
                        'id' => $row->id,
                        'name' => $row->makes->name . " " . $row->models->name . " " . $data['year'],
                        'amount' => '$' . number_format($row->amount, 2),
                        'image' => global_asset($row->image),
                        'akl' => $row->akl == 1 ? 'Yes' : 'No',
                        'oem' => $row->oem == 1 ? 'OEM' : 'Aftermarket',
                        'PN' => $row->PN,
                        'opt' => $li,
                        'ser_pri' => $ser_pri,
                    ];
                }
            });
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

    public function search_call(Request $request)
    {
        return $request;
    }

    public function create(Request $request)
    {
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
