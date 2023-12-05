<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Llamada extends Model
{
    use HasFactory;

    protected $fillable = [
        'interpreterID',
        'horaInicio',
        'horaFin',
        'empresaCliente',
        'proveedor',
        'lenguaLEP',
        'tipo',
        'especializacion'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id');
    }

    public function rcp(){
        return $this->hasMany(RCP::class);
    }
}