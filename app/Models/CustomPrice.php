<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomPrice extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'service',
        'make',
        'model',
        'year',
        'remote',
        'key_type_id',
        'oem',
        'pts',
        'akl',
    ];

    public function leadItem(){
        return $this->hasMany(LeadItem::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll(['*']);
    }
}
