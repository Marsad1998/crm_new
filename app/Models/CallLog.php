<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CallLog extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'lead_id',
        'user_id',
        'status',
        'incoming',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function model()
    {
        return $this->hasOneThrough(PriceManager::class, LeadItem::class, 'lead_id', 'id', 'lead_id', 'price_id');
    }

    public function lead_items()
    {
        return $this->belongsTo(LeadItem::class, 'lead_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll(['*']);
    }
}
