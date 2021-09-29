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
        'financement',
        'doc_presentation',
        'logo',
        'secteur',
        'user',
        'etat',
        'avancement',
        'complet',
    ];

    public function membres(){
        return $this->hasMany(Equipe::class, 'projet', 'id');
    }

    public function user_data()
    {
        return $this->belongsTo(Role::class, 'user', 'id');
    }
}

