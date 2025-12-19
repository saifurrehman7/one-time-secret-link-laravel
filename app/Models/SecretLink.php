<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecretLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'secret_text',
        'slug',
        'expires_at',
        'viewed_at',
        'is_burned',
        'first_url',
    ];

    protected $casts = [
        'secret_text' => 'encrypted',
        'expires_at' => 'datetime',
        'viewed_at' => 'datetime',
        'is_burned' => 'boolean',
        'first_url' => 'boolean',
    ];
}
