<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            DB::table('users')->insert([

//                [
//                    'id'=>1,
//                    'role_id' => 1,
//                    "name"=>"Руководитель проекта",
//                    "phone"=>"+77777777777",
//                    "email"=>"admin@gmail.com",
//                    "password"=>bcrypt("admin123"),
//                    "status"=>1,
//                ],
//                [
//                    'id'=>2,
//                    'role_id' => 2,
//                    "user_type"=>2,
//                    "bin"=>"0123456789",
//                    "name"=>"Пользователь проекта",
//                    "phone"=>"+70777777777",
//                    "email"=>"user2@gmail.com",
//                    "password"=>bcrypt("admin123"),
//                    "status"=>1,
//                ],
//                [
//                    'id'=>3,
//                    'role_id' => 2,
//                    "user_type"=>1,
//                    "bin"=>"0123456789",
//                    "name"=>"ТОО компания проекта",
//                    "phone"=>"+70877777777",
//                    "email"=>"user2@gmail.com",
//                    "password"=>bcrypt("admin123"),
//                    "status"=>1,
//                ],



            ]);


    }
}
