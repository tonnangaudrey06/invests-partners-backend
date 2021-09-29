<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_membre',
        'telephone_membre',
        'email_membre',
        'photo_membre',
        'cni_membre',
        'pays_membre',
        'ville_membre',
        'profession_membre',
        'date_naissance_membre',
        'parcours_membre',
    ];

    public function projet(){
        return $this->belongsTo(Projet::class, 'projet', 'id');
    }
}


