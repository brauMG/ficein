<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContanciaInversion extends Model
{
    use HasFactory;

    protected $table = 'constacias_de_inversion';

    protected $fillable = [
        'id_client',
        'operation_number',
        'type',
        'date',
        'file_pdf',
    ];

    public $timestamps = true;

    public function client() {
        return $this->belongsTo(User::class, 'id_client', 'id_client');
    }
}
