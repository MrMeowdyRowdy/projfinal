<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $fillable = [
        'horaInicio',
        'horaFin',
        'detalle'
    ];

    public function course()
    {
        return $this->belongsTo(User::class); // links this->course_id to courses.id
    }
}