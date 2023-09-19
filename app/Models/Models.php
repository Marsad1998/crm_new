<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Models extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = ['name', 'make_id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll(['*']);
    }

    public function make()
    {
        return $this->belongsTo(Makes::class);
    }
}
