<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'lieu',
        'date_evenement',
        'heure_debut',
        'prix',
        'places',
        'duree',
    ];

    public function participants()
    {
        return $this->hasMany(Participant::class, 'evenement', 'id');
    }

}
