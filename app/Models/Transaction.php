<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'projet_id',
        'event_id',
        'trans_id',
        'telephone',
        'methode',
        'montant',
        'valider',
        'type',
        'etat'
    ];

    protected $casts = [
        'valider' => 'boolean'
    ];

    protected $appends =  [
        'type_complet',
        'etat_complet'
    ];


    public function getTypeCompletAttribute()
    {
        switch ($this->type) {
            case 'INSCRIPTION':
                return 'Paiement lors d\'une inscription';
                break;
            case 'PROFIL':
                return 'Paiement lors de la mise à jour d\'une plage d\'investissement';
                break;
            case 'PROFIL':
                return 'Paiement lors de l\'enregistrement à un événement';
                break;
            default:
                return 'Paiement lors de la validation d\'un projet';
                break;
        }
    }

    public function getEtatCompletAttribute()
    {
        switch ($this->etat) {
            case 'INITIE':
                return 'Initié';
                break;
            case 'REUSSI':
                return 'Réussi';
                break;
            default:
                return 'Échoué';
                break;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function projet()
    {
        return $this->belongsTo(Projet::class, 'projet_id', 'id');
    }

    public function event()
    {
        return $this->belongsTo(Evenement::class, 'event_id', 'id');
    }
}
