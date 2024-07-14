<?php

namespace Database\Seeders;

use App\Models\Administrativo;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdministrativoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name'=> 'Juan Perez',
            'email'=> 'juan@gmail.com',
            'password' => bcrypt('1234'),
        ])->assignRole('Director');

        Administrativo::create([
            'nombre'=>$user1->name,
            'ci'=>"87453412",
            'ci_ex'=>"SC",
            'fecha_nac'=>"1980-12-01",
            'telefono'=>"78985634",
            'user_id'=>$user1->id
        ]);

        $user2 = User::create([
            'name'=> 'Adriana Gomez',
            'email'=> 'adriana@gmail.com',
            'password' => bcrypt('1234'),
        ])->assignRole('Secretaria');
        
        Administrativo::create([
            'nombre'=>$user2->name,
            'ci'=>"84553412",
            'ci_ex'=>"SC",
            'fecha_nac'=>"1990-12-01",
            'telefono'=>"78956634",
            'user_id'=>$user2->id
        ]);
    }
}
