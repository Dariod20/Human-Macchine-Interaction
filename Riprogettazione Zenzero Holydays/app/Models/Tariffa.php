<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariffa extends Model
{
    use HasFactory;
    protected $table = "tariffa";
    // public timestamps = false;
    // use SoftDeletes;

    protected $fillable = ['giorno','prezzo'];

    public function prenotazione()
    {
        return $this->belongsTo(Prenotazione::class, 'prenotazione_id','id');

    }
}
