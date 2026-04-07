<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billet extends Model
{
    protected $fillable = [
        'id_commande',
        'id_voyage',
        'qte',
        'nom_passager',
        'prenom_passager',
        'cin_passager',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'id_commande');
    }

    public function voyage()
    {
        return $this->belongsTo(Voyage::class, 'id_voyage');
    }
}
