<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'civilite',
        'prenom',
        'nom',
        'folder',
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
        'nom_complet',
        'anciennete_complet'
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

    public function getAncienneteCompletAttribute($value)
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

    public function documents_fiscaux()
    {
        return $this->hasMany(DocumentFiscaux::class, 'user', 'id');
    }

    public function secteurs_data()
    {
        return $this->hasMany(Secteur::class, 'user', 'id')->with(['projets']);
    }

    public function profil_invest()
    {
        return $this->belongsTo(ProfilInvestisseur::class, 'profil', 'id');
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'privileges', 'user', 'module')->withPivot('consulter', 'modifier', 'ajouter', 'supprimer');
    }

    public static function writeReport($folder, $data)
    {
        try {
            $json = [];
            $path = storage_path("app/uploads/$folder/report.json");
            if (File::exists($path)) {
                $json = json_decode(file_get_contents($path), true);
                if (empty($json)) {
                    $json = [];
                }
            }
            array_push($json, $data);
            $json = json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            Storage::disk('local')->put("uploads/$folder/report.json", $json);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
