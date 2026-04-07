<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = ['id_client', 'date_comm'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_client');
    }

    public function voyages()
    {
        return $this->belongsToMany(Voyage::class, 'billets', 'id_commande', 'id_voyage')
            ->withPivot('qte');
    }

    public function billets()
    {
        return $this->hasMany(Billet::class, 'id_commande');
    }
}
