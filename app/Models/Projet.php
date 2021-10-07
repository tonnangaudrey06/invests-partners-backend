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

    protected $appends =  [
        'etat_complet',
        'avancement_complet'
    ];

    public function getEtatCompletAttribute()
    {
        switch ($this->etat) {
            case 'ATTENTE':
                return 'En attente';
                break;
            case 'VALIDE':
                return 'Validé';
                break;
            case 'COMPLET':
                return 'Étude terminé';
                break;
            case 'ATTENTE_VALIDATION_ADMIN':
                return 'En attente de validation administrative';
                break;
            case 'ATTENTE_PAIEMENT':
                return 'En attente de paiement';
                break;
            case 'REJETE':
                return 'Rejeté';
                break;
            case 'CLOTURE':
                return 'Financement colecté';
                break;
            default:
                return 'Publié';
                break;
        }
    }

    public function getAvancementCompletAttribute()
    {
        switch ($this->avancement) {
            case 'IDEE':
                return 'Juste l\'idée';
                break;
            case 'PROTOTYPE':
                return 'Prototype';
                break;
            default:
                return 'Sur le marché';
                break;
        }
    }

    public function membres()
    {
        return $this->belongsToMany(Membre::class, 'equipes', 'projet', 'membre')->withPivot('statut');
    }

    public function secteur_data()
    {
        return $this->belongsTo(Secteur::class, 'secteur', 'id')->with(['conseiller_data']);
    }

    public function medias()
    {
        return $this->hasMany(Archive::class, 'projet', 'id');
    }

    public function investissements()
    {
        return $this->hasMany(Investissement::class, 'projet', 'id')->with(['user_data']);
    }

    public function user_data()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}
