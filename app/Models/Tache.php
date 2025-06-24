<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'user_id',
        'date_debut',
        'date_echeance',
        'entreprise',
        'description',
        'categorie',
        'priorite',
        'statut',
        'commentaire',
    ];

    protected $casts = [
        'date' => 'datetime',
        'date_debut' => 'datetime',
        'date_echeance' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
