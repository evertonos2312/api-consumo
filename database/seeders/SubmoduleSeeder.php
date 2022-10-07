<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Module;
use App\Models\Submodule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubmoduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = Module::get();
        $nomes = ['Contábil', 'Trabalhista', 'Tributária'];
        if(!empty($modules)){
            foreach ($modules as $module) {
                foreach ($nomes as $nome) {
                    Submodule::create([
                        'nome' => $nome,
                        'module_id' => $module->id,
                    ]);
                }
            }
        }
    }
}
