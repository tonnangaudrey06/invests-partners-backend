<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secteur extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'slug',
        'user',
        'photo',
    ];

    public function conseille()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

    
}
