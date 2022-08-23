<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            'name'=>'ZESHAN RABNAWAZ',
            'email'=>'zeshan111@gmail.com',
            'password'=>'12345678',
            'mobile'=>'123456789',

        ]);
    }
}
