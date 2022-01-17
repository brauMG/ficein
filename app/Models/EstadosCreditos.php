<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadosCreditos extends Model
{
    use HasFactory;

    protected $table = 'estados_de_cuenta_creditos';

    protected $fillable = [
        'email',
        'date',
        'file_pdf',
    ];

    public $timestamps = true;

    public function client() {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
