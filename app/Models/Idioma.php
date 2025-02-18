<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    //
    public function alumno(){
        return $this->belongsTo(Alumno::class);
    }

}
