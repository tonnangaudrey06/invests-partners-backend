<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
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

    public function privileges()
    {
        return $this->hasOne(Privilege::class, 'user', 'id')->withPivot('consulter', 'modifier', 'ajouter', 'supprimer');
    }
}
