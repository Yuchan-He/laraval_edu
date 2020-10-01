<?php

use Illuminate\Database\Seeder;

class MemberTableSeeder extends Seeder
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
        for($i = 0; $i < 500; $i++){
        	$data[] = [
		        'username' 	=> $faker -> username,
		        'password'	=> bcrypt('password'),
		        'gender'	=> rand(1,3),
		        'mobile'	=> $faker -> phoneNumber,
		        'email'		=> $faker -> email(40),
		        'avatar'	=> '/statics/avatar.jpg',
		        'created_at'=> date('Y-m-d H:i:s'),
		        'type'		=> rand(1,2),
		        'status'	=> rand(1,2)	
        	];
        }
        //insert the data to the table
        DB::table('member') -> insert($data);
    }
}
