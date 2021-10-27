<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investissement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'projet',
        'date_versement',
        'montant',
    ];


    public function projet_data(){
        return $this->belongsTo(Projet::class, 'projet', 'id');
    }


    public function user_data()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}
