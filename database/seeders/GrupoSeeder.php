<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('grupo')->insert([
            ['nombre_grupo' => 'A', 'cuatrimestre' => '1', 'estatus' => 'Activo'],
            ['nombre_grupo' => 'B', 'cuatrimestre' => '1', 'estatus' => 'Activo'],
            ['nombre_grupo' => 'C', 'cuatrimestre' => '1', 'estatus' => 'Activo'],
            ['nombre_grupo' => 'D', 'cuatrimestre' => '1', 'estatus' => 'Activo'],
            ['nombre_grupo' => 'E', 'cuatrimestre' => '1', 'estatus' => 'Activo'],
        ]);
    }
}