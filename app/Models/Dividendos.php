<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dividendos extends Model
{
    use HasFactory;

    protected $table = 'dividendos';

    protected $fillable = [
        'rfc',
        'date',
        'file_pdf',
    ];

    public $timestamps = true;

    public function client() {
        return $this->belongsTo(User::class, 'rfc', 'rfc');
    }
}
