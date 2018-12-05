<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultoriosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('consultorios')->insert([
            'razao_social' => str_random(50),
            'nome' => str_random(10),
            'active' => true,
            'user_id' => 1
        ]);
    }
}
