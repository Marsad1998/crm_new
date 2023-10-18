<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuoteConfig extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'service_id',
        'option_id',
        'sort_no',
    ];

    public function category()
    {
        return $this->hasOneThrough(Category::class, Service::class, 'id', 'id', 'service_id', 'category_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll(['*']);
    }
}
