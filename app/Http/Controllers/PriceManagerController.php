<?php

namespace App\Http\Controllers;

use App\Models\Makes;
use App\Models\Models;
use App\Models\Option;
use App\Models\Tenant;
use App\Models\Service;
use App\Models\OptionValue;
use App\Models\PriceManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PriceManagerController extends Controller
{
    public function index()
    {
        // return storage_path() . '/' . PriceManager::latest()->first()->image;
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
                    'image' => $filename,
                ];

                PriceManager::create($data);
            }
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
