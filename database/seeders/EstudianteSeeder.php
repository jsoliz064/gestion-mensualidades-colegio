<?php

namespace Database\Seeders;

use App\Models\Estudiante;
use App\Models\Tutor;
use Illuminate\Database\Seeder;

class EstudianteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t1=Tutor::create([
            'nombre'=>"Javier Soliz",
            'ci'=>"8949354",
            'ci_ex'=>"SC",
            'fecha_nac'=>"1980-12-01",
            'telefono'=>"69086228",
            'parentesco'=>"Padre",
        ]);

        $t2=Tutor::create([
            'nombre'=>"Miguel Perez",
            'ci'=>"8949334",
            'ci_ex'=>"SC",
            'fecha_nac'=>"1980-12-01",
            'telefono'=>"69086228",
            'parentesco'=>"Padre",
        ]);

        $t3=Tutor::create([
            'nombre'=>"Gabriela Paz",
            'ci'=>"8949354",
            'ci_ex'=>"SC",
            'fecha_nac'=>"1980-12-01",
            'telefono'=>"69086228",
            'parentesco'=>"Padre",
        ]);

        $e1=Estudiante::create([
            'nombre'=>"Jose Daniel",
            'apellidos'=>"Soliz Supayabe",
            'fecha_nac'=>"1980-12-01",
            'codigo'=>"10000",
            'curso_id'=>1
        ])->syncTutores($t1);

        $e2=Estudiante::create([
            'nombre'=>"Darwin",
            'apellidos'=>"Perez Gomez",
            'fecha_nac'=>"1980-12-01",
            'codigo'=>"10001",
            'curso_id'=>1
        ])->syncTutores($t2);

        $e3=Estudiante::create([
            'nombre'=>"Angelica",
            'apellidos'=>"Mamani Paz",
            'fecha_nac'=>"1980-12-01",
            'codigo'=>"10002",
            'curso_id'=>1
        ])->syncTutores($t3);

        

    }
}
