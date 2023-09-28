<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Category;
use Illuminate\Http\Request;

class QuoteConfigController extends Controller
{
    public function config()
    {
        return view('tenant.quote_config');
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
}
