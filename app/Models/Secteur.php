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
        'user'
    ];

    public function user_data()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

    public function image()
    {
        return $this->hasOne(Archive::class, 'secteur', 'id');
    }
}
