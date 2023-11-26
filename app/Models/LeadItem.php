<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeadItem extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'lead_id',
        'price_id',
        'type',
        'qty',
    ];

    public function price(){
        return $this->belongsTo(PriceManager::class, "price_id");
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll(['*']);
    }
}
