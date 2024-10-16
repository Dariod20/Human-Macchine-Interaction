<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dl = new DataLayer();
        $prenotazioni = $dl->listaPrenotazioniUtente(session('loggedID'));
        return view('utentePrenotazioni.prenotazioniUtente')->with('prenotazioni', $prenotazioni);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nome = $request->input('nome');
        $cognome= $request->input('cognome');
        $email= $request->input('email');
        $stato = $request->input('stato');
        $telefono = $request->input('telefono');
        $orarioArrivo = $request->input('orarioArrivo');

        $arrivo = $request->input('arrivo');
        $partenza = $request->input('partenza');
        $numAdulti = $request->input('numAdulti');
        $numBambini = $request->input('numBambini');
   


        //aggiungo libro al db con metodo del datalayer
        $dl = new DataLayer();
        $costoTotale= $dl->calcoloCostoTotale($arrivo,$partenza);

        $dl->addPrenotazione($arrivo,$partenza,$numAdulti,$numBambini,$costoTotale,$nome,$cognome,$email,$telefono,$stato,$orarioArrivo,session('loggedID'));
        //torno sulla vista della lista dei libri
        return Redirect::to(route('prenotazioniUtente.index'))->with('success', __('messages.reservation_success'));
    }

    public function show(string $id)
    {
        $dl = new DataLayer();
        $prenotazione = $dl->findPrenotazioneById($id);

        if ($prenotazione !== null) {
            return view('utentePrenotazioni.detailsPrenotazione')->with('prenotazione',$prenotazione);
        }
    }

    public function confirmDestroy($id) {
        $dl = new DataLayer();
        $prenotazione = $dl->findPrenotazioneById($id);
        // Verifica se l'utente è il proprietario della prenotazione
        if ((!(session('loggedID')))||(session('loggedID')!= $prenotazione->user_id)) {
            return view('errors.404',['message' => 'Non hai il permesso di eliminare questa prenotazione poichè non ti appartiene.']);
        }else{
            $arrivo = Carbon::parse($prenotazione->arrivo);
            $cancellabile= Carbon::now()->diffInDays($arrivo, false) >=2;
            if ($cancellabile){
                return view('utentePrenotazioni.deletePrenotazione')->with('prenotazione', $prenotazione);
            } else{
                return view('errors.404')->with('message','Non è possibile cancellare gratuitamente la prenotazione poiché mancano meno di due giorni all\'arrivo. <br>
                <strong>Verrà rimborsato solo il 75% dell\'importo totale</strong>, mentre il 25% verrà trattenuto.<br> 
                Per cancellare la prenotazione e ottenere il parziale rimborso ti invitiamo a contattare la struttura via email all\'indirizzo: <a href="mailto:dina.colpani@gmail.com" class="contact-text">dina.colpani@gmail.com</a>');
            }
        }
        

    }

    public function destroy(string $id)
    {
        $dl = new DataLayer();
        $dl->deletePrenotazione($id);
        return Redirect::to(route('prenotazioniUtente.index'))->with('success', __('messages.cancellation_success'));
    }


    public function showCalendar()
    {
        
        $dl = new DataLayer();
        $tariffe= $dl->listaTariffe();
        return view('pages.fullCalendar')->with('tariffe', $tariffe);
    }
}
