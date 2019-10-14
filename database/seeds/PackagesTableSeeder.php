<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->insert([
        	['name' => 'trial', 'lifetime' => 2, 'price' => config('e-persistant.prices.trial')],
        	['name' => 'bulanan', 'lifetime' => 1, 'price' => config('e-persistant.prices.bulanan')],
            ['name' => 'tahunan', 'lifetime' => 12, 'price' => config('e-persistant.prices.tahunan')],
            ['name' => 'expired', 'lifetime' => 0, 'price' => config('e-persistant.prices.expired')]
        ]);
    }
}
