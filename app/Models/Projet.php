<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'intitule',
        'media',
        'pays_activite',
        'ville_activite',
        'site',
        'description',
        'financement',
        'doc_presentation',
        'logo',
        'categorie',
        'user',
        'etat',
        'accepté',
        'en_attente',
        'publié',
    ];

    public function membres(){
        return $this->hasMany(Equipe::class, 'projet', 'id');
    }
}

