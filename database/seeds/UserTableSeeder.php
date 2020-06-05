<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = User::create([
    		'name' => 'admin',
    		'email' => 'admin@mail.com',
    		'password' => bcrypt('admin123'),
    		'e_password' => 'admin123',
            'nip' => null,
            'id_skp' => null,
            'nip_hashed' => null,
    	]);

        $user->assignRole('administrator');
    }
}
