<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Paralelo;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Curso::create([
            'nombre'=>"Primero",
            'nivel'=>"Secundaria",
            'paralelo'=>"A"
        ]);

        Curso::create([
            'nombre'=>"Primero",
            'nivel'=>"Secundaria",
            'paralelo'=>"B"
        ]);

        Curso::create([
            'nombre'=>"Primero",
            'nivel'=>"Secundaria",
            'paralelo'=>"C"
        ]);

        Curso::create([
            'nombre'=>"Segundo",
            'nivel'=>"Secundaria",
            'paralelo'=>"A"

        ]);

        Curso::create([
            'nombre'=>"Segundo",
            'nivel'=>"Secundaria",
            'paralelo'=>"B"
        ]);

        Curso::create([
            'nombre'=>"Segundo",
            'nivel'=>"Secundaria",
            'paralelo'=>"C"
        ]);


        Curso::create([
            'nombre'=>"Tercero",
            'nivel'=>"Secundaria",
            'paralelo'=>"A"
        ]);

        Curso::create([
            'nombre'=>"Tercero",
            'nivel'=>"Secundaria",
            'paralelo'=>"B"
        ]);

        Curso::create([
            'nombre'=>"Tercero",
            'nivel'=>"Secundaria",
            'paralelo'=>"C"
        ]);

        Curso::create([
            'nombre'=>"Cuarto",
            'nivel'=>"Secundaria",
            'paralelo'=>"A"
        ]);

        Curso::create([
            'nombre'=>"Cuarto",
            'nivel'=>"Secundaria",
            'paralelo'=>"B"
        ]);

        Curso::create([
            'nombre'=>"Cuarto",
            'nivel'=>"Secundaria",
            'paralelo'=>"C"
        ]);

        Curso::create([
            'nombre'=>"Quinto",
            'nivel'=>"Secundaria",
            'paralelo'=>"A"
        ]);

        Curso::create([
            'nombre'=>"Quinto",
            'nivel'=>"Secundaria",
            'paralelo'=>"B"
        ]);

        Curso::create([
            'nombre'=>"Quinto",
            'nivel'=>"Secundaria",
            'paralelo'=>"C"
        ]);

        Curso::create([
            'nombre'=>"Sexto",
            'nivel'=>"Secundaria",
            'paralelo'=>"A"
        ]);

        Curso::create([
            'nombre'=>"Sexto",
            'nivel'=>"Secundaria",
            'paralelo'=>"B"
        ]);

        Curso::create([
            'nombre'=>"Sexto",
            'nivel'=>"Secundaria",
            'paralelo'=>"C"
        ]);
    }
}
