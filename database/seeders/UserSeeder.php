<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //QueryBulider
        // اضافة بياانت ع الجداول
        DB::table('users')->insert([
            // 'col'=>'value',
            'name'=>'nivin shabat',
            'email'=>'nivin@gmail.com',
            'password'=> Hash::make('password'),//,md-5,sha,rsa
            //تشفير كلمة السر

            // لو بدي اضيف اكتر من يوزر بكرر الكود اكتر من مرة
        ]);


        //QueryBulider

        // \DB::table('users')->insert([
        //     // 'col'=>'value',
        //     'name'=>'alaa',
        //     'email'=>'alaa@gmail.com',
        //     'password'=>\Hash::make('password'),//,md-5,sha,rsa
        // ]);


    }
}
