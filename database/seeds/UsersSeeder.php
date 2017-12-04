<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
	        'name' => "Akmal",
	        'email' => "akmal.fahrurizal@gmail.com",
	        'password' => bcrypt('secret'),
	    ]); 

        DB::table('users')->insert([
            'name' => "Fahrurizal",
            'email' => "makmalfdev@gmail.com",
            'password' => bcrypt('secret'),
        ]);
    }
}
