<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenotazione extends Model
{
    use HasFactory;
    protected $table = "prenotazione";
    // public timestamps = false;
    // use SoftDeletes;

    protected $fillable = ['arrivo','partenza','numAdulti','numBambini','prezzoTotale','nome','cognome','email','telefono','stato','orarioArrivo'];

    public function tariffe()
    {
        return $this->hasMany(Tariffa::class, 'prenotazione_id','id');

    }
}
