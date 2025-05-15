<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'content',
        'type',
        'scanned_at',
        'description'
    ];
    
    protected $casts = [
        'scanned_at' => 'datetime',
    ];
}
