<?php

namespace Database\Seeders;

use App\Models\Alumno;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Alumno::factory()->count(5)->create()->each(function (Alumno $alumno)
            $numero_idiomas_hablados=rand(0,4);
            if ($numero_idiomas_hablados > 0)
                $this->addIdiomasAlumnos($alumno, $numero_idiomas_hablados)
        }
        //
    }
}
