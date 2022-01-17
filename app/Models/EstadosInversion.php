<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadosInversion extends Model
{
    use HasFactory;

    protected $table = 'estados_de_cuenta_inversiones';

    protected $fillable = [
        'email',
        'currency',
        'date',
        'file_pdf',
    ];

    public $timestamps = true;

    public function client() {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
