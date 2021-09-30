<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'role', 'id');
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'privileges', 'role', 'module')->withPivot('consulter', 'modifier', 'ajouter', 'supprimer');
    }
}
