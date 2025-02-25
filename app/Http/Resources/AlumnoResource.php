<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlumnoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ["data"=>["type"      =>"Alumnos",
                         "id"        =>(string)$this->id,
                         "attributes"=>[
                              "nombre"=>$this->nombre,
                              "edad"  =>$this->edad,
                              "email" =>$this->email
                                      ],
                         "links"     =>["self"=>"http://localhost:8000/api/alumnos/$this->id"]

        ]];
    }
}



