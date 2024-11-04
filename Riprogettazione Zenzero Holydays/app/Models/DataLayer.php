<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class DataLayer extends Model
{
    public function validPassword($username, $password) {
        $user = User::where('email', $username)->first();

        if($user && Hash::check($password, $user->password))
        {
            return true;
        } else {
            return false;
        }
    }

    public function listaPrenotazioni(){
        $prenotazioni= Prenotazione::orderBy('arrivo', 'desc')->get();
        return $prenotazioni;
    }

    public function findPrenotazioneById($id){
        return Prenotazione::find($id);
   }

   public function listaTariffe(){
    $tariffe= Tariffa::orderBy('giorno', 'asc')->get();
    return $tariffe;
   }

   public function findTariffaById($id){
    return Tariffa::find($id);
    }

   public function calcoloCostoTotale($arrivo, $partenza)
    {
        $arrivo = Carbon::parse($arrivo);
        $partenza = Carbon::parse($partenza);

        // Estrai le tariffe per ciascun giorno di pernottamento e calcola il costo totale
        $costoTotale = Tariffa::where('giorno', '>=', $arrivo)->where('giorno', '<', $partenza)->sum('prezzo');

        return $costoTotale;
    }



   public function addPrenotazione($arrivo,$partenza,$numAdulti,$numBambini,$prezzoTotale,$nome,$cognome,$email,$telefono,$stato,$orarioArrivo,$userID){

    $prenotazione = new Prenotazione();
    $prenotazione->arrivo = $arrivo;
    $prenotazione->partenza = $partenza;
    $prenotazione->numAdulti = $numAdulti;
    $prenotazione->numBambini = $numBambini;
    $prenotazione->prezzoTotale = $prezzoTotale;
    $prenotazione->nome = $nome;
    $prenotazione->cognome = $cognome;
    $prenotazione->email = $email;
    $prenotazione->telefono = $telefono;
    $prenotazione->stato = $stato;
    $prenotazione->orarioArrivo = $orarioArrivo;
    $prenotazione->user_id = $userID;

    $prenotazione->save();
    Tariffa::where('giorno', '>=', $arrivo)->where('giorno', '<', $partenza)->update(['prenotazione_id' => $prenotazione->id]);
   }

   public function editPrenotazione($id, $arrivo,$partenza,$numAdulti,$numBambini,$prezzoTotale,$nome,$cognome,$email,$telefono,$stato,$orarioArrivo) {
    $prenotazione = Prenotazione::find($id);
    $tariffeAssociate=$prenotazione->tariffe;
    foreach ($tariffeAssociate as $tariffa){
        $tariffa->prenotazione_id = null;
        $tariffa->save(); // Salva la tariffa per applicare la modifica
    }

    Tariffa::where('giorno', '>=', $arrivo)->where('giorno', '<', $partenza)->update(['prenotazione_id' => $prenotazione->id]);

    $prenotazione->arrivo = $arrivo;
    $prenotazione->partenza = $partenza;
    $prenotazione->numAdulti = $numAdulti;
    $prenotazione->numBambini = $numBambini;
    $prenotazione->prezzoTotale = $prezzoTotale;
    $prenotazione->nome = $nome;
    $prenotazione->cognome = $cognome;
    $prenotazione->email = $email;
    $prenotazione->telefono = $telefono;
    $prenotazione->stato = $stato;
    $prenotazione->orarioArrivo = $orarioArrivo;



    $prenotazione->save();



   }

   public function deletePrenotazione($id) {
    $prenotazione = Prenotazione::find($id);
    if ($prenotazione) {
        // Libera le tariffe associate impostando il campo prenotazione_id a null
        $prenotazione->tariffe()->update(['prenotazione_id' => null]);

        // Cancella la prenotazione
        $prenotazione->delete();
    }
   }

   public function addTariffa($giorno,$prezzo){

    $tariffa = new Tariffa();
    $tariffa->giorno = $giorno;
    $tariffa->prezzo = $prezzo;

    $tariffa->save();
/*     Prenotazione::where('giorno', '>=', $arrivo)->where('giorno', '<', $partenza)->update(['prenotazione_id' => $prenotazione->id]);
 */   }

   public function checkPrenotazioniSovrapposte($arrivo, $partenza, $prenotazioneId = null)
   {
       $prenotazioni = $this->listaPrenotazioni();
       $occupiedDates = [];

       $arrivo = Carbon::parse($arrivo);
       $partenza = Carbon::parse($partenza);


       foreach ($prenotazioni as $prenotazione) {
           $prenotazioneArrivo = Carbon::parse($prenotazione->arrivo);
           $prenotazionePartenza = Carbon::parse($prenotazione->partenza);

           // Verifica se la nuova prenotazione si sovrappone con una prenotazione esistente
           if (
               $prenotazione->id != $prenotazioneId && // Ignora la prenotazione corrente se esiste
               (
                    ($arrivo->lt($prenotazionePartenza) && $partenza->gt($prenotazioneArrivo))
               )
           ) {
               $occupiedDates[] = [
                   'arrivo' => $prenotazioneArrivo->format('d-m-y'),
                   'partenza' => $prenotazionePartenza->format('d-m-y')
               ];
           }
       }

       return $occupiedDates;
   }

   public function checkTariffeDisponibili($arrivo, $partenza)
    {


        $allTariffeExist = true;
        $missingDates = [];
        $prezzo = 0;

        // Clona l'oggetto arrivo per evitare modifiche alla data originale
        $currentDate = $arrivo->copy();

        while ($currentDate->lte($partenza)) {
            $giorno = $currentDate->format('Y-m-d');
            $tariffa = Tariffa::where('giorno', $giorno)->first();

            if (!$tariffa) {
                $allTariffeExist = false;
                $missingDates[] = $giorno;
            }

            $currentDate->addDay();
        }

        if ($allTariffeExist) {
            $prezzo = $this->calcoloCostoTotale($arrivo, $partenza);
        }

        return [
            'allTariffeExist' => $allTariffeExist,
            'missingDates' => $missingDates,
            'costoTotale' => $prezzo
        ];
    }

    public function getDatePrenotazioni()
    {
        $prenotazioni = Prenotazione::all();
        $bookings = [];

        foreach ($prenotazioni as $prenotazione) {
            $startDate = Carbon::parse($prenotazione->arrivo);
            $endDate = Carbon::parse($prenotazione->partenza);

            for ($date = $startDate; $date->lt($endDate); $date->addDay()) {
                $bookings[] = $date->format('Y-m-d');
            }
        }

        return $bookings;
    }


    public function getUserID($email) {
        $users = User::where('email',$email)->get(['id']);
        return $users[0]->id;
    }

    public function getUserName($email) {
        $users = User::where('email',$email)->get(['name']);
        return $users[0]->name;
    }

    public function getUserRole($email) {
        $users = User::where('email',$email)->get(['role']);
        return $users[0]->role;
    }

    public function findUserByemail($email) {
        $users = User::where('email', $email)->get();

        if (count($users) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function addUser($name, $password, $email) {
        $user = new User();
        $user->name = $name;
        $user->password = Hash::make($password);
        $user->email = $email;
        $user->role = "registered_user";
        $user->email_verified_at = now();
        $user->save();
    }


    public function listaPrenotazioniUtente($userID) {
        $bookings  = Prenotazione::where('user_id',$userID)->orderBy('arrivo','desc')->get();
        return $bookings;
    }

    public function findTariffaByGiorno($giorno, $giornoFino){
        $tariffe = Tariffa::whereBetween('giorno', [$giorno, $giornoFino])->get();

        return $tariffe;
    }

    public function editTariffa($id, $giorno, $prezzo) {
        $tariffa = Tariffa::find($id);
        $tariffa->giorno = $giorno;
        $tariffa->prezzo = $prezzo;


        $tariffa->save();

       }

    public function deleteTariffa($id)
    {
        $tariffa = Tariffa::find($id);
        if ($tariffa) {
            $tariffa->delete();
        }
    }

    public function checkTariffePrenotate($giorno, $giornoFino)
    {
        $tariffePrenotate = Tariffa::whereBetween('giorno', [$giorno, $giornoFino])
                            ->whereHas('prenotazione')
                            ->pluck('giorno');


        return $tariffePrenotate;
    }

    public function editGruppoTariffe($giorno, $giornoFino, $prezzo)
    {
        $tariffe = Tariffa::whereBetween('giorno', [$giorno, $giornoFino])->get();

        foreach ($tariffe as $tariffa) {
            $tariffa->prezzo = $prezzo;
            $tariffa->save();
        }

    }

    public function getDateRangeForTariffe()
    {
        $oldestTariffa= Tariffa::orderBy('giorno', 'asc')->first();
        $latestTariffa= Tariffa::orderBy('giorno', 'desc')->first();

        // Restituisci le date più vecchia e più futura
        return [
            'minDate' => $oldestTariffa ? $oldestTariffa->giorno : null,
            'maxDate' => $latestTariffa ? $latestTariffa->giorno : null,
        ];
    }

    public function validUser($email, $password) {
        $user = User::where('email', $email)->first();

        if($user && Hash::check($password, $user->password)) {
            return true;
        } else {
            return false;
        }
    }


}


