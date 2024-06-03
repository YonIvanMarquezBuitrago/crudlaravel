<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;
    protected $fillable=['nombre','carpeta_id'];

    /*Relaciones Uno a Muchos (Inversa)*/
    public function carpeta()
    {
        return $this->belongsTo(Carpeta::class);
    }
}
