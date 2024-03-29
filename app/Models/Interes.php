<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interes extends Model
{
    use HasFactory;

    protected $table = 'intereses';

    protected $fillable = [
        'rfc',
        'date',
        'file_pdf',
        'file_xml',
    ];

    public $timestamps = true;

    public function client() {
        return $this->belongsTo(User::class, 'rfc', 'rfc');
    }
}
