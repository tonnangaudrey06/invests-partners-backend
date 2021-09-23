<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'module',
        'consulter',
        'modifier',
        'ajouter',
        'supprimer'
    ];

    protected $casts = [
        'consulter' => 'boolean',
        'modifier' => 'boolean',
        'ajouter' => 'boolean',
        'supprimer' => 'boolean'
    ];
}
