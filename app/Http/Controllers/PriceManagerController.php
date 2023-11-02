<?php

namespace App\Http\Controllers;

use App\Models\Makes;
use App\Models\Models;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\PriceManager;
use App\Models\Service;
use Illuminate\Http\Request;

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

            foreach ($service_id as $y => $value1) {
                $data = [
                    'make_id' => $value,
                    'model_id' => ($request->model_id)[$x] ?? null,
                    'model_name' => ($request->model_name)[$x] ?? null,
                    'year_from' => ($request->year_from)[$x] ?? null,
                    'year_to' => ($request->year_to)[$x] ?? null,
                    'make_name' => ($request->make_name)[$x] ?? null,
                ];

                $data = [
                    'service_id' => $value1,
                    'key_type' => ($request->key_type)[$x] ?? null,
                    'key_manu' => ($request->key_manu)[$x] ?? null,
                    'comfort_access' => ($request->comfort_access)[$x] ?? null,
                    'amount' => ($request->amount)[$x] ?? null,
                    'notes' => ($request->notes)[$x] ?? null,
                    'akl' => ($request->akl)[$x] ?? null,
                    'file' => ($request->file)[$x] ?? null,
                ];
            }

            PriceManager::create($data);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PriceManager $priceManager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PriceManager $priceManager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PriceManager $priceManager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PriceManager $priceManager)
    {
        //
    }
}
