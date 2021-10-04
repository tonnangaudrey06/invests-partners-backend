<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'intitule',
        'folder',
        'pays_activite',
        'ville_activite',
        'site',
        'description',
        'taux_rentabilite',
        'duree',
        'rsi',
        'ca_previsionnel',
        'financement',
        'doc_presentation',
        'logo',
        'secteur',
        'user',
        'etat',
        'avancement',
        'complet',
    ];

    public function membres()
    {
        return $this->belongsToMany(Membre::class, 'equipes', 'projet', 'membre')->withPivot('statut');
    }

    public function secteur_data(){
        return $this->belongsTo(Secteur::class, 'secteur', 'id');
    }

    public function medias(){
        return $this->hasMany(Archive::class, 'projet', 'id');
    }

    public function user_data()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}

