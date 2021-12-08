<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturacion extends Model
{
    use HasFactory;

    protected $table = 'facturaciones';

    protected $fillable = [
        'id_client',
        'contract_name',
        'date',
        'file_pdf',
        'file_xml',
    ];

    public $timestamps = true;

    public function client() {
        return $this->belongsTo(User::class, 'id_client', 'id_client');
    }
}
