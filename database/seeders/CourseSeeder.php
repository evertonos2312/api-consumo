<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(storage_path() . "/cursos.json");
        $courses = json_decode($json,true);

        if(!empty($courses)){
            foreach ($courses as $course) {
                Course::create([
                    'nome' => $course['nome'],
                    'tipo' => $course['tipo'],
                    'id_mp' => $course['id_mp'] ?: NULL
                ]);
            }
        }
    }
}
