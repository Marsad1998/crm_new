<?php

namespace App\Http\Controllers;

use App\Models\OptionValue;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class OptionValueController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'option_value_name' => 'required',
        ]);

        OptionValue::create([
            'name' => $request->option_value_name,
            'amount' => $request->option_value_amount,
            'slug' => Str::slug($request->option_value_name),
            'option_id' => Crypt::decrypt($id),
        ]);
        return response()->json(['msg' => 'Option Value Added Successfully', 'sts' => 'success']);
    }

    public function modify(Request $request)
    {
        $id = substr(base64_decode($request->id), 5, -5);
        if ($request->type == 'delete') {
            OptionValue::findOrFail($id)->delete();
            return response()->json(['msg' => 'Option Value Deleted', 'sts' => 'success']);
        } else {
            return OptionValue::with('option')->findOrFail($id);
        }
    }

    public function update(Request $request, $option_v_id)
    {
        $request->validate([
            'option_value_name' => 'required',
        ]);
        $option_v_id = substr(base64_decode($option_v_id), 5, -5);
        OptionValue::findOrFail($option_v_id)->update([
            'name' => $request->option_value_name,
            'amount' => $request->option_value_amount,
            'slug' => Str::slug($request->option_value_name),
        ]);
        return response()->json(['msg' => 'Option Value Added Successfully', 'sts' => 'success']);
    }

    public function destroy($id)
    {
        OptionValue::findOrfail(Crypt::decrypt($id))->delete();
        return response()->json(['msg' => 'Option Value Deleted Successfully', 'sts' => 'error']);
    }
}
