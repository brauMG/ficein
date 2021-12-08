<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interes extends Model
{
    use HasFactory;

    protected $table = 'intereses';

    protected $fillable = [
        'id_client',
        'date',
        'file_pdf',
    ];

    public $timestamps = true;

    public function client() {
        return $this->belongsTo(User::class, 'id_client', 'id_client');
    }
}
