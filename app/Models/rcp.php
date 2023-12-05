<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RCP extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'mensaje'
    ];

    public function user(){
        return $this->belongsTo(User::class,'id');
    }

    public function llamada(){
        return $this->belongsTo(Llamada::class,'id');
    }


}