<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilInvestisseur extends Model
{
    use HasFactory;
    
    protected $table = 'profile_investisseurs';

    protected $fillable = [
        'type',
        'montant_min',
        'montant_max'
    ];

    public function getMontantMaxAttribute($value)
    {
        if (empty($value)) {
            return 'Plus';
        }
        return $value . ' XAF';
    }

    public function getMontantMinAttribute($value)
    {
        return $value . ' XAF';
    }
}
