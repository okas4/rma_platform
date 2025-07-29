<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    protected $table = 'dossiers';
    protected $fillable = [
        'user_id',
        'montant',
        'statut',
        'motif_refus',
        'fichier_path',
        'updated_by', // Assuming you want to store the file path
    ];
    public function updatedBy()
{
    return $this->belongsTo(User::class, 'updated_by');
}


    public function user()
{
    return $this->belongsTo(User::class);
}

}
