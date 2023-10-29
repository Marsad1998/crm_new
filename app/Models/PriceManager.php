<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriceManager extends Model
{
    use HasFactory;

    public function index()
    {
        return view('tenant.price');
    }
}
