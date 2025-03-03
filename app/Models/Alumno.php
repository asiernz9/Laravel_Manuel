<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    /** @use HasFactory<\Database\Factories\AlumnoFactory> */
    use HasFactory;

    protected $table = 'alumnos';
    protected $primaryKey = 'id';
    protected $timestamp = true;

    protected $fillable = ["nombre","email","edad"];

    public function idiomas(){
        return $this->hasMany(Idioma::class);
    }

    // Updated relationship with Projects
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'alumno_project', 'alumno_id', 'project_id')
            ->withTimestamps();
    }
}
