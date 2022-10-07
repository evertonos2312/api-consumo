<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create();
        $courses = Course::limit(100)->get();
        if(!empty($courses)){
            foreach ($courses as $course) {
                for ($i = 1; $i < 5; $i ++) {
                Lesson::create([
                    'course_id' => $course->id,
                    'inicio' =>  $faker->dateTimeBetween('now', '+1 month'),
                    'termino' => $faker->dateTimeBetween('+1 month', '+2 month'),
                ]);
                }
            }
        }
    }
}
