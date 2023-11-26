<?php

namespace App\Http\Controllers;

use App\Models\CustomPrice;
use App\Models\Lead;
use App\Models\Models;
use App\Models\Option;
use App\Models\CallLog;
use App\Models\Service;
use App\Models\Category;
use App\Models\LeadItem;
use App\Models\OptionValue;
use App\Models\QuoteConfig;
use Illuminate\Support\Str;
use App\Models\PriceManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use App\Http\Requests\QuoteSearch;
use Illuminate\Support\Facades\Crypt;

class QuoteConfigController extends Controller
{
    public function config()
    {
        return view('tenant.quotes.create');
    }

    public function index()
    {
        $categories = Category::has('services')->get();
        return view('tenant.quotes.create', compact('categories'));
    }

    public function view()
    {
        return view('tenant.quotes.index');
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
                                <strong>
                                    <span>' . $option->option->name . '</span>: <span>' . $option->name . '</span>
                                </strong>
                                <br>
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
//            ->when(isset($data['type-of-key']), function ($query) use ($data) {
//                return $query->where('key_type_id', $data['type-of-key']);
//            })
//            ->when(isset($data['does-the-vehicle-use-push-to-start-or-knob-turn-to-start']), function ($query) use ($data) {
//                return $query->where('pts', $data['does-the-vehicle-use-push-to-start-or-knob-turn-to-start']);
//            })
//            ->when(isset($data['is-there-comfort-access']), function ($query) use ($data) {
//                return $query->where('oem', $data['is-there-comfort-access']);
//            })
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

    public function load_index()
    {
        $data = CallLog::with('lead', 'lead_items', 'user', 'model.models')->get();
        return Datatables::of($data)
            ->addColumn('phone', function ($row) {
                if (!is_null($row->lead)) {
                    return $row->lead->phone;
                } else {
                    return 'N/A';
                }
            })
            ->addColumn('name', function ($row) {
                if (!is_null($row->lead)) {
                    return $row->lead->name;
                } else {
                    return 'N/A';
                }
            })
            ->addColumn('last_quoted', function ($row) {
                if (!is_null($row->lead)) {
                    return '$' . number_format($row->lead->last_quoted, 2);
                } else {
                    return 'N/A';
                }
            })
            ->addColumn('notes', function ($row) {
                if (!is_null($row->lead)) {
                    return '<a title="' . $row->lead->notes . '">' . Str::limit($row->lead->notes, 15) . '</a>';
                } else {
                    return 'N/A';
                }
            })
            ->addColumn('vehicle', function ($row) {
                // return $;
            })
            ->addIndexColumn()
            ->rawColumns(['notes'])
            // ->with('models', $models)
            ->make(true);
    }

    public function search_call(Request $request)
    {
        $leads = Lead::with(["callLog", "leadLatest" => function($query){
            $query->with("price");
        }])->wherePhone($request->phone)->get();

//        dd($leads);
//        return $leads;

        return view("tenant.quotes.ajax.records", compact('leads'))->render();
    }

    public function save_lead(Request $request)
    {
//        return $request->all();

        $validation = Validator::make($request->all(), [
            'status' => 'required', // Assuming it's a radio button with values 4 and 5
            'phone_number' => 'required',
        ]);

        $validation->setCustomMessages([
            'status.required' => 'Status field is required',
        ]);

        if ($validation->fails()) {
            // If validation fails, return a JSON response with errors and input data
            return response()->json([
                'errors' => $validation->errors(),
                'input' => $request->all(),
            ], 200); // You can customize the HTTP status code as needed
        }



        $item = [
            'phone' => $request->phone_number,
            'name' => $request->caller_name,
            'last_quoted' => $request->sub_total,
            'notes' => $request->notes,
        ];

        $res1 = Lead::create($item);

        $oem = 0;
        if($request->key_manufacturer){
            $options = OptionValue::find($request->key_manufacturer);
            if($options && ($options->name == "OEM")){
                $oem = 1;
            }
        }

        $options = $request->options;

        $year = null;
        $akl = null;
        $typeOfKey = null;
        $pts = null;
        if($options['year']){
            $year = $options['year'];
        }
        if($options['type-of-key']){
            $typeOfKey = $options['type-of-key'];
        }
        if($options['does-the-vehicle-use-push-to-start-or-knob-turn-to-start']){
            $pts = $options['does-the-vehicle-use-push-to-start-or-knob-turn-to-start'];
        }
        if($options['has-the-customer-lost-all-the-spare-keys']){
            $akl = $options['has-the-customer-lost-all-the-spare-keys'];
        }



        $modelPrices = [
            'model_id' => $request->model,
            'category_id' => $request->category_id,
            'make' => $request->make,
            'service_id' => $request->service_id,
            'year_start' => $year,
            'key_type_id' => $typeOfKey,
            'amount' => $request->quoted_price,
            'oem' => $oem,
            'pts' => $pts,
            'akl' => $akl,
        ];

        $manager = PriceManager::create($modelPrices);


        $lead_items = [
            'lead_id' => $res1->id,
            'price_id' => $manager->id,
            'type' => "regular",
            'qty' => 1,
        ];

        LeadItem::create($lead_items);

        $call_log = [
            'lead_id' => $res1->id,
            'user_id' => auth()->user()->id,
            'status' => $request->status,
            'incoming' => $request->call_type,
            'notes' => $request->notes,
        ];

        CallLog::create($call_log);


        $callerType = null;
        $locations = null;
        $caaaaa = null;
        $daynightRate = null;
        $akl = null;
        if($options['caller-type']){
            $callerType = $options['caller-type'];
        }
        if($options['locations']){
            $locations = $options['locations'];
        }
        if($options['caaaaa']){
            $caaaaa = $options['caaaaa'];
        }
        if($options['daynight-rate']){
            $daynightRate = $options['daynight-rate'];
        }
        if($options['locations']){
            $locations = $options['locations'];
        }
        if($options['has-the-customer-lost-all-the-spare-keys']){
            $akl = $options['has-the-customer-lost-all-the-spare-keys'];
        }

        $custom_price = [
            'lead_id' => $res1->id,
            'caller_type' => $callerType,
            'locations' => $locations,
            'caa' => $caaaaa,
            'day_night' => $daynightRate,
            'lost_spare_keys' => $akl,
        ];

        CustomPrice::create($custom_price);

        return response()->json(['msg' => 'Quote Saved Successfully', 'sts' => 'success']);
    }

    public function getLeadDetail(Request $request){
        $lead = Lead::with(["callLog", "customPrice", "leadLatest" => function($query){
            $query->with("price");
        }])->whereId($request->id)->first();

        $categories = Category::has('services')->get();

        $serviceId = null;
        $categoryId = null;
        $prices = null;
        $makeId = null;
        if($lead->leadLatest && $lead->leadLatest->price){
            $serviceId = $lead->leadLatest->price->service_id;
        }
        if($lead->leadLatest && $lead->leadLatest->price){
            $prices = $lead->leadLatest->price;
        }
        if($lead->leadLatest && $lead->leadLatest->price && $lead->leadLatest->price->services){
            $categoryId = $lead->leadLatest->price->services->category_id;
        }
        if($prices){
            $make = Models::find($prices->model_id);
            if($make){
                $makeId = $make->make_id;
            }
        }


        $data["serviceId"] = $serviceId;
        $data["categoryId"] = $categoryId;
        $data["prices"] = $prices;
        $data["lead"] = $lead;
        $data["makeId"] = $makeId;

        return $data;
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
