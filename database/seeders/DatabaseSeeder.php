<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Makes;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'johndoe@example.com',
            'role_id' => 1,
            'status' => 1,
            'password' => Hash::make("secret"),
        ]);

        // $tenant = Tenant::create([
        //     'id' => 'quotegen',
        // ]);

        // $tenant->domains()->create([
        //     'domain' => 'test.localhost',
        // ]);
    }
}
