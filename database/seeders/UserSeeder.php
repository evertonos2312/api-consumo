<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(storage_path() . "/usuarios.json");
        $users = json_decode($json,true);

        if(!empty($users)){
            foreach ($users as $user) {
                try {
                    User::create([
                        'name' => $user['nome'],
                        'email' => $user['email'],
                        'status' => $user['ativo'],
                        'is_admin' => $user['is_admin'],
                        'old_password' => $user['senha']
                    ]);
                }
                catch (\Illuminate\Database\QueryException $e) {
                    //
                }
            }
        }
    }
}
