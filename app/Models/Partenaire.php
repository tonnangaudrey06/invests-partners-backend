<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Partenaire extends Model
{
    use HasFactory;

    protected $fillable = ['image']; 

//     public function evenements()
// {
//     return $this->hasMany(Evenement::class, 'partenaire_id');
// }

    
     
}
