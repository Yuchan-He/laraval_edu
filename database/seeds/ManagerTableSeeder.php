<?php

use Illuminate\Database\Seeder;

class ManagerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create data by faker
        $faker = \Faker\Factory::create('ja_JP');
        //useing loop to create data 
        $data = []; 
        for($i = 0; $i < 100; $i++){
        	$data[] = [
		        'username' 	=> $faker -> username(20),
		        'password'	=> bcrypt('123456'),
		        'gender'	=> rand(1,3),
		        'mobile'	=> $faker -> phoneNumber,
		        'email'		=> $faker -> email(40),
		        'role_id'	=> rand(1,5),
		        'created_at'=> date('Y-m-d H:i:s'),
		        'status'	=> rand(1,2)	
        	];
        }
        //insert the data to the table
        DB::table('manager') -> insert($data);
    }
}
