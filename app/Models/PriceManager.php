<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriceManager extends Model
{
    use HasFactory;

    protected $table = 'model_prices';

    protected $fillable = [
        'model_id',
        'is_range',
        'year_start',
        'year_end',
        'service_id',
        'key_type_id',
        'PN',
        'image',
        'pts',
        'oem',
        'akl',
        'amount',
    ];

    public function services()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function models()
    {
        return $this->belongsTo(Models::class, 'model_id');
    }

    public function makes()
    {
        return $this->hasOneThrough(Makes::class, Models::class, 'id', 'id', 'model_id', 'make_id');
    }

    public function keys()
    {
        return $this->belongsTo(OptionValue::class, 'key_type_id');
    }
}
