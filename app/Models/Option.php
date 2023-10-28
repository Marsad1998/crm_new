<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = ['name', 'type', 'option_category', 'operator'];

    public function option_values()
    {
        return $this->hasMany(OptionValue::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll(['*']);
    }
}
