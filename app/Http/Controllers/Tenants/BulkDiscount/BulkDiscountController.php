<?php

namespace App\Http\Controllers\Tenants\BulkDiscount;

use App\Http\Controllers\Controller;
use App\Models\BulkDiscount;
use Illuminate\Http\Request;

class BulkDiscountController extends Controller
{

    public function index(){
        $discounts = BulkDiscount::with("KeyType")->get();
        return view('tenant.ajax.bulk-discounts-records', compact('discounts'))->render();
    }

    public function store(Request $request){

        BulkDiscount::create([
            "key_type_id" => $request->key_type,
            "key_number" => $request->key_number,
            "multiplier" => $request->multiplier,
            "state" => $request->state
        ]);

    }

    public function toggle(Request $request){

        $bulk = BulkDiscount::find($request->id);
        if($bulk){
            if($bulk->state == 0){
                $bulk->update(["state" => 1]);
            }else{
                $bulk->update(["state" => 0]);
            }
        }

        return response()->json("success");
    }

}
