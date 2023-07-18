<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB::Table('classrooms')->insert([
            'name'=>'salwa',
            'code'=>'123',
            'section'=>'Laravel',
            'subject'=>'Programming',
            'room'=>'Jersualem',
            'cover_image_path'=>'https://getbootstrap.com/docs/5.3/forms/overview/#overview',
            'Theme'=>'hello',
            'user_id'=>1,
            'status'=>'active',
            // 'timestamps'=>'now',

        ]

        );
    }
}
