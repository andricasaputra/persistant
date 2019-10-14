<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        	['name' => 'administrator', 'guard_name' => 'api'],
        	['name' => 'user', 'guard_name' => 'api'],
            ['name' => 'subscriber', 'guard_name' => 'api'],
            ['name' => 'unsubscriber', 'guard_name' => 'api'],
            ['name' => 'trial', 'guard_name' => 'api'],
        ]);
    }
}

