<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            [
                'bank_name' => 'Bank of Ceylon',
                'bank_code' => '01',
                'account_number_length' => 12,
            ],
            [
                'bank_name' => 'People’s Bank',
                'bank_code' => '05',
                'account_number_length' => 12,
            ],
            [
                'bank_name' => 'Hatton National Bank (HNB)',
                'bank_code' => '10',
                'account_number_length' => 10,
            ],
            [
                'bank_name' => 'Commercial Bank of Ceylon',
                'bank_code' => '70',
                'account_number_length' => 13,
            ],
            [
                'bank_name' => 'Sampath Bank',
                'bank_code' => '01',
                'account_number_length' => 10,
            ],
            [
                'bank_name' => 'Nations Trust Bank',
                'bank_code' => '15',
                'account_number_length' => 10,
            ],
            [
                'bank_name' => 'DFCC Bank',
                'bank_code' => '12',
                'account_number_length' => 12,
            ],
            [
                'bank_name' => 'Cargills Bank',
                'bank_code' => '25',
                'account_number_length' => 10,
            ],
            [
                'bank_name' => 'Union Bank of Colombo',
                'bank_code' => '90',
                'account_number_length' => 12,
            ],
            [
                'bank_name' => 'Seylan Bank',
                'bank_code' => '07',
                'account_number_length' => 10,
            ],
        ];

        foreach ($banks as $bank) {
            DB::table('banks')->insert([
                'bank_name' => $bank['bank_name'],
                'bank_code' => $bank['bank_code'],
                'length' => $bank['account_number_length'],
            ]);
        }


    }
}
