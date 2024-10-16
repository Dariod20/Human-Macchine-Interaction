<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;


class AdminBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dl=new DataLayer();
        $prenotazioni= $dl->listaPrenotazioni();
        return view('adminPrenotazioni.prenotazioni')->with('prenotazioni',$prenotazioni);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminPrenotazioni.editPrenotazione');
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
        $numBambini = $request->input('numBambini');



        //aggiungo libro al db con metodo del datalayer
        $dl = new DataLayer();
        $costoTotale= $dl->calcoloCostoTotale($arrivo,$partenza);

        $dl->addPrenotazione($arrivo,$partenza,$numAdulti,$numBambini,$costoTotale,$nome,$cognome,$email,$telefono,$stato,$orarioArrivo,session('loggedID'));
        //torno sulla vista della lista dei libri
        return Redirect::to(route('prenotazioniAdmin.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dl = new DataLayer();
        $prenotazione = $dl->findPrenotazioneById($id);

        if ($prenotazione !== null) {
            return view('adminPrenotazioni.detailsPrenotazione')->with('prenotazione',$prenotazione);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dl = new DataLayer();
        $prenotazione = $dl->findPrenotazioneById($id);
        
        if ($prenotazione !== null) {
            return view('adminPrenotazioni.editPrenotazione')->with('prenotazione', $prenotazione);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Recupero dati inseriti nei campi della form per aggiunta nuovo libro
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

        $dl = new DataLayer();
        $costoTotale= $dl->calcoloCostoTotale($arrivo,$partenza);
        $dl->editPrenotazione($id, $arrivo,$partenza,$numAdulti,$numBambini,$costoTotale,$nome,$cognome,$email,$telefono,$stato,$orarioArrivo);
        return Redirect::to(route('prenotazioniAdmin.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dl = new DataLayer();
        $dl->deletePrenotazione($id);
        return Redirect::to(route('prenotazioniAdmin.index'));
    }

    public function confirmDestroy($id) {
        $dl = new DataLayer();
        $prenotazione = $dl->findPrenotazioneById($id);
        return view('adminPrenotazioni.deletePrenotazione')->with('prenotazione', $prenotazione);
    }

    
    public function ajaxCheckPrenotazione(Request $request)
    {
        $arrivo = Carbon::parse($request->input('arrivo'));
        $partenza = Carbon::parse($request->input('partenza'));
    
        // Controllo che le date di arrivo e partenza non coincidano
        if ($arrivo->eq($partenza)) {
            return response()->json(['found' => true, 'occupiedDates' => [['arrivo' => $arrivo->toDateString(), 'partenza' => $partenza->toDateString()]], 'error' => 'La data di arrivo e partenza non possono coincidere.']);
        }
    
        $dl = new DataLayer();
        $occupiedDates = $dl->checkPrenotazioniSovrapposte($arrivo, $partenza, $request->input('prenotazioneId'));
    
        if (!empty($occupiedDates)) {
            return response()->json(['found' => true, 'occupiedDates' => $occupiedDates]);
        } else {
            return response()->json(['found' => false]);
        }
    }
    
    public function ajaxCheckTariffePrenotazione(Request $request)
    {
        $arrivo = Carbon::parse($request->input('arrivo'));
        $partenza = Carbon::parse($request->input('partenza'));
        $context = $request->input('context'); // Ottieni il parametro context

    
        $dl = new DataLayer();
        $result = $dl->checkTariffeDisponibili($arrivo, $partenza);
    
        if (!$result['allTariffeExist']) {
            return response()->json([
                'available' => false,
                'message' => 'Tariffe mancanti per i seguenti giorni: ' . implode(', ', $result['missingDates']),
                'context' => $context                
            ]);
        }
    
        return response()->json(['available' => true]);
    }

    public function ajaxCalcolaPrezzoTotale(Request $request)
    {
        $arrivo = $request->input('arrivo');
        $partenza = $request->input('partenza');


        $dl = new DataLayer();
        // Esegui la logica per calcolare il prezzo totale delle tariffe tra arrivo e partenza
        $prezzoTotale = $dl->calcoloCostoTotale($arrivo,$partenza);

        return response()->json(['prezzoTotale' => $prezzoTotale]);
    }

    

    public function confermaPrenotazione($arrivo)
    {
        return view('adminPrenotazioni.editPrenotazione')->with('arrivo', $arrivo);
    }


}