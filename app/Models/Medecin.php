<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'cin',
        'email',
        'telephone',
        'specialite_id',
    ];

    public function specialite() {
        return $this->belongsTo(Specialite::class);
    }

    public function creneaux() {
         return $this->hasMany(Creneau::class); 

    }
    public function rendezVous()
{
    return $this->hasMany(RendezVous::class);
    
}
}
