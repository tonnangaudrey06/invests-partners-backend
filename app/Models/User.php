<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'civilite',
        'prenom',
        'nom',
        'email',
        'telephone',
        'password',
        'photo',
        'anciennete',
        'status',
        'profil',
        'role',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $appends =  [
        'nom_complet'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNomCompletAttribute()
    {
        if (empty($this->civilite)) {
            return $this->nom . ' ' . $this->prenom;
        } else {
            return $this->civilite . ' ' . $this->nom . ' ' . $this->prenom;
        }
    }

    public function getAnciennetetAttribute($value)
    {
        if ($value == 1) {
            return 'Plus d\'un ans d\'anciennete';
        } else if ($value == -1) {
            return 'Moins d\'un ans d\'anciennete';
        } else {
            return null;
        }
    }

    public function role_data()
    {
        return $this->belongsTo(Role::class, 'role', 'id');
    }

    public function projets()
    {
        return $this->hasMany(Projet::class, 'user', 'id');
    }

    public function secteur()
    {
        return $this->hasOne(Secteur::class, 'user', 'id');
    }
}
