<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('superadmin')
        ]);

        Company::create([
            'name' => 'Company 1',
            'email' => 'company1@admin.com',
            'address' => 'Company 1 address',
            'latitude' => '0.533505',
            'longitude' => '101.447403',
            'radius_km' => 1,
            'time_in' => '00:07:00',
            'time_out' => '00:17:00'
        ]);
    }
}
