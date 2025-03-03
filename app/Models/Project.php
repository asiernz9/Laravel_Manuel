<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'estimated_hours',
        'start_date',
        'user_id'
    ];

    protected $casts = [
        'start_date' => 'date'
    ];

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = is_string($value) 
            ? Carbon::parse($value)->format('Y-m-d') 
            : $value;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}