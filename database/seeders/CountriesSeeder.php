<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name' => 'China', 'code' => 'CN'],
            ['name' => 'India', 'code' => 'IN'],
            ['name' => 'United Kingdom', 'code' => 'GB'],
            ['name' => 'Japan', 'code' => 'JP'],
            ['name' => 'United States', 'code' => 'US'],
            ['name' => 'United Arab Emirates', 'code' => 'AE'],
            ['name' => 'Saudi Arabia', 'code' => 'SA'],
            ['name' => 'Pakistan', 'code' => 'PK'],
            ['name' => 'Turkey', 'code' => 'TR'],
            ['name' => 'Russia', 'code' => 'RU'],
            ['name' => 'Egypt', 'code' => 'EG'],
            ['name' => 'Iran', 'code' => 'IR'],
            ['name' => 'Sri Lanka', 'code' => 'LK'],
            ['name' => 'South Korea', 'code' => 'KR'],
            ['name' => 'Taiwan', 'code' => 'TW'],
            ['name' => 'Hong Kong', 'code' => 'HK'],
            ['name' => 'Indonesia', 'code' => 'ID'],
            ['name' => 'Malaysia', 'code' => 'MY'],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
