<?php

namespace Database\Seeders;
use Database\Factories\TopicFactory;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Topic::factory()->count(10)->create();


        // \App\Models\Topic::factory(10)->create();
    //     //10  بحدد كم يوزر بدي انشا
    //     // carete  انشاء
    //     //   راح يكرر  الكود الموجود في يوزر فاكتروس
// طريقة اخرى
    //     \App\Models\User::factory()->create([
    //         'name' => 'hema User',
    //         'email' => 'hema@example.com',
    // //     ]);
    //     \App\Models\Topic::factory(3)->create();
    //         \App\Models\Topic::factory()->create([
    //         'name' => 'nora',
    //         'classroom_id' => '1',
    //         'user_id'=>'1',
        // ]);







        // //Querybulider

        // $this->call([
        //     // UserSeeder::class,
        //     ClassroomsSeeder::class

        // ]

        // );

    }
}
