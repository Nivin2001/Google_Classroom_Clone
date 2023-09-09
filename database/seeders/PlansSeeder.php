<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Seed plans
        \App\Models\Plan::insert([
            [
                'name' => 'Free Plan',
                'price' => 0,
            ],
            [
                'name' => 'Basic Plan',
                'price' => 2000,
            ],
            [
                'name' => 'Pro Plan',
                'price' => 8000,
            ],
        ]);

        // Seed features
        \App\Models\Feature::insert([
            [
                'name' => 'classroom #',
                'code' => 'classroom-count',
            ],
            [
                'name' => 'student per classroom',
                'code' => 'classroom-students',
            ],
        ]);

        // Seed plan features
        \Illuminate\Support\Facades\DB::table('plan_feature')->insert([
            ['plan_id' => 1, 'feature_id' => 1, 'feature_value' => 1],
            ['plan_id' => 1, 'feature_id' => 2, 'feature_value' => 10],
            ['plan_id' => 2, 'feature_id' => 1, 'feature_value' => 5],
            ['plan_id' => 2, 'feature_id' => 2, 'feature_value' => 30],
            ['plan_id' => 3, 'feature_id' => 1, 'feature_value' => 100],
            ['plan_id' => 3, 'feature_id' => 2, 'feature_value' => 1000],
        ]);
    }
}


