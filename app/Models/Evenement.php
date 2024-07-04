<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'lieu',
        'date_debut',
        'date_fin',
        'heure_debut',
        'heure_fin',
        'heure_debut',
        'prix',
        'places',
        'image',
        'fichier',
        'description',
        //'duree',
        //'partenaire_image',
    ];

    protected $appends =  [
        'total_reserve',
        'isPast'
    ];

    public function getTotalReserveAttribute()
    {
        $places = Participant::select(DB::raw('sum(places) as total'))->where('evenement', $this->id)->first();

        if (empty($places->total)) {
            return 0;
        }
        return (int) $places->total;
    }

    public function getIsPastAttribute()
    {
        return Carbon::now()->startOfDay()->gte($this->date_debut);
    }

        public function participants()
    {
        return $this->hasMany(Participant::class, 'evenement', 'id');
    }
     
}
