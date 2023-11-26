<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'phone',
        'name',
        'last_quoted',
        'notes',
    ];

    public function callLog(){
        return $this->hasOne(CallLog::class);
    }

    public function leadItems(){
        return $this->hasMany(LeadItem::class);
    }

    public function leadLatest(){
        return $this->hasOne(LeadItem::class)->orderByDesc("id");
    }

    public function price(){
        return $this->hasOneThrough(LeadItem::class, CustomPrice::class, 'price_id', 'lead_id');
    }

    public function customPrice(){
        return $this->hasOne(CustomPrice::class);
    }




    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll(['*']);
    }
}
