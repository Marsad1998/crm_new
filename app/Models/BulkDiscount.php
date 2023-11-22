<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulkDiscount extends Model
{
    use HasFactory;

    public $fillable = [
        "key_type_id", "key_number", "multiplier", "state"
    ];

    public function KeyType(){
        return $this->belongsTo(OptionValue::class, 'key_type_id', 'id');
    }
}
