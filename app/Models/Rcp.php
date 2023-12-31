<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rcp extends Model
{
    use HasFactory;

    protected $fillable = [
        'interpreterID',
        'llamadaID',
        'fecha',
        'tipo',
        'catastrofico',
        'mensaje'
    ];

    public function user(){
        return $this->belongsTo(User::class,'id');
    }

    public function llamada(){
        return $this->belongsTo(Llamada::class,'id');
    }

    public function tipo(){
        return $this->hasOne(TipoRcp::class,'id');
    }
    public function catastrofico(){
        return $this->hasOne(Catastrofico::class,'id');
    }
}