<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',
        'url',
        'user',
        'projet',
        'actualite',
        'categorie'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie', 'id');
    }

    // public function projet()
    // {
    //     return $this->belongsTo(Categorie::class, 'categorie', 'id');
    // }

    // public function actualite()
    // {
    //     return $this->belongsTo(Categorie::class, 'categorie', 'id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}
