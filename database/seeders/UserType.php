<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if(DB::table('user_types')->count() == 0){

            DB::table('user_types')->insert([

                [
                    'id'=>1,
                    'title' => "Юр.лицо",
                ],
                [
                    'id'=>2,
                    'title' => "Физ.лицо",
                ],



            ]);

        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}
