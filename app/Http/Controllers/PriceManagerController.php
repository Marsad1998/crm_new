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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
