<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $table = 'contacto';

    protected $fillable = [
        'texto',
        'numero_1',
        'numero_2',
        'numero_3',
        'correo_1',
        'correo_2',
        'correo_3',

    ];

    public $timestamps = true;
}
