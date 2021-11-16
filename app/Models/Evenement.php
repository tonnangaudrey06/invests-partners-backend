<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        'image',
        'description',
        'duree',
    ];

    protected $appends =  [
        'total_reserve'
    ];

    public function getTotalReserveAttribute()
    {
        $places = Participant::select(DB::raw('sum(places) as total'))->where('evenement', $this->id)->first();

        if (empty($places->total)) {
            return 0;
        }
        return (int) $places->total;
    }

    public function participants()
    {
        return $this->hasMany(Participant::class, 'evenement', 'id');
    }

}
