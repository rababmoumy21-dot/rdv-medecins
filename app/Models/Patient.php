<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = ['nom',
    'prenom',
    'cin',
    'telephone',
    'email',
    'date_naissance',
    'adresse'];

    public function rendezVous() {
        return $this->hasMany(RendezVous::class);
    }


}
