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
    private function addIdiomasAlumnos(Alumno $alumno, int $numero_idiomas):void{
        $idiomas =collect(config("idiomas"))->shuffle()->slice(0,$numero_idiomas);
        $niveles=["Alto","Medio","Básico"];
        $titulos=["A1","A2","B1","B2","C1","C2"];
        $idiomas->each(fn($idioma)=>
               $alumno->idiomas()->create([
                   "idioma"=>$idioma,
                   "titulo"=>collect($titulos)->random(),
                   "nivel"=>collect($niveles)->random(),
               ])
        );



    }
    public function run(): void
    {
        Alumno::factory()->count(5)->create()->each(function (Alumno $alumno){
            $numero_idiomas_hablados=rand(0,4);
            if ($numero_idiomas_hablados > 0)
                $this->addIdiomasAlumnos($alumno, $numero_idiomas_hablados);
        });
        //
    }
}
