<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Alumno;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'estimated_hours', 
        'start_date',
        'user_id'
    ];

    protected $dates = [
        'start_date'
    ];

    public function setStartDateAttribute($value)
    {
        // If value is already a Carbon instance, use it directly
        if ($value instanceof \Carbon\Carbon) {
            $this->attributes['start_date'] = $value->format('Y-m-d');
        } 
        // If value is a string, parse it 
        elseif (is_string($value)) {
            // Try to parse the date, handling different formats
            try {
                $parsedDate = \Carbon\Carbon::parse($value);
                $this->attributes['start_date'] = $parsedDate->format('Y-m-d');
            } catch (\Exception $e) {
                // If parsing fails, set to null or keep original value
                $this->attributes['start_date'] = null;
            }
        } 
        // For other types (like null), set directly
        else {
            $this->attributes['start_date'] = $value;
        }
    }

    public function getStartDateAttribute($value)
    {
        // If value is already a Carbon instance, return it
        if ($value instanceof \Carbon\Carbon) {
            return $value;
        }
        
        // If value is a string, parse it to Carbon
        if (is_string($value)) {
            try {
                return \Carbon\Carbon::parse($value);
            } catch (\Exception $e) {
                // If parsing fails, return null
                return null;
            }
        }
        
        // For other types, return as is
        return $value;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'alumno_project', 'project_id', 'alumno_id');
    }
}