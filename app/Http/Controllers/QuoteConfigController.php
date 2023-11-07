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
