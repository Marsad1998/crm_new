<?php

namespace App\Http\Controllers;

use App\Models\Makes;
use App\Models\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ModelsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'model_name' => 'required',
            'make_id' => 'required',
        ]);
        Models::create([
            'name' => $request->model_name,
            'make_id' => $request->make_id
        ]);

        return response()->json(['msg' => 'Models Added Successfully', 'sts' => 'success']);
    }

    public function show(Request $request)
    {
        $term = $request->term;
        return Makes::when($term, function ($row) use ($term) {
            $row->where('name', 'LIKE', '%' . $term . '%');
        })->get();
    }

    public function edit($id)
    {
        $id = substr(base64_decode($id), 5, -5);
        return [
            Models::with('make')->whereId($id)->first(),
            'models'
        ];
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'model_name' => 'required',
            'make_id' => 'required'
        ]);

        $id = substr(base64_decode($id), 5, -5);
        Models::findOrFail($id)->update([
            'name' => $request->model_name,
            'make_id' => $request->make_id,
        ]);

        return response()->json(['msg' => 'Model Updated Successfully', 'sts' => 'success']);
    }

    public function destroy($id)
    {
        $id = substr(base64_decode($id), 5, -5);
        Models::findOrFail($id)->delete();
        return response()->json(['msg' => 'Models Deleted Successfully', 'sts' => 'success']);
    }
}
