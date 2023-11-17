<?php

namespace Database\Seeders;

use App\Models\CallLog;
use App\Models\Lead;
use App\Models\LeadItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CallLogs extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CallLog::factory(10)->create();
        LeadItem::factory(10)->create();
        Lead::factory(10)->create();
    }
}
