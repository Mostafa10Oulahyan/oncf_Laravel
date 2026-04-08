<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    protected $fillable = [
        'code_voyage',
        'heureDepart',
        'villeDepart',
        'heureDarrivee',
        'villeDarrivee',
        'prixVoyage',
        'is_promo',
        'price_promo',
    ];

    /**
     * Returns the effective price (promo price if active, else regular price).
     */
    public function getEffectivePriceAttribute(): float
    {
        return ($this->is_promo && $this->price_promo !== null)
            ? $this->price_promo
            : $this->prixVoyage;
    }

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'billets', 'id_voyage', 'id_commande')
            ->withPivot('qte');
    }

    public function billets()
    {
        return $this->hasMany(Billet::class, 'id_voyage');
    }
}
