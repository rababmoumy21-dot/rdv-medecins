<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    use HasFactory;

    protected $table = 'rendez_vous'; // nom exact de la table
    protected $primaryKey = 'id';

    protected $fillable = [
        'statut',
        'creneau_id',
        'patient_id',
    ];

    // Relations
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function creneau()
    {
        return $this->belongsTo(Creneau::class);
    }
}

/* namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    protected $table = 'rendez_vous';

    protected $fillable = [
        'patient_id',
        'creneau_id',
        'statut'
    ];

    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    public function creneau() {
        return $this->belongsTo(Creneau::class);
    }

}
 */