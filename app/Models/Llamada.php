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
        return $this->belongsTo(User::class);
    }

    public function empresaCliente(){
        return $this->hasOne(EmpresaCliente::class);
    }

    public function proveedor(){
        return $this->hasOne(Proveedor::class);
    }
}