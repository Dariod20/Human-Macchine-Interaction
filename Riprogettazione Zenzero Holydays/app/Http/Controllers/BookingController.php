<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Mail\CustomMail;
use Illuminate\Support\Facades\Mail;

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
   
        if (is_null($numBambini)) {
            $numBambini = 0; // Imposta a 0 se è null
        }


        //aggiungo libro al db con metodo del datalayer
        $dl = new DataLayer();
        $costoTotale= $dl->calcoloCostoTotale($arrivo,$partenza);

        $dl->addPrenotazione($arrivo,$partenza,$numAdulti,$numBambini,$costoTotale,$nome,$cognome,$email,$telefono,$stato,$orarioArrivo,session('loggedID'));

        $arrivoMail= Carbon::parse($request->arrivo)->format('d/m/Y');
        $partenzaMail=Carbon::parse($request->partenza)->format('d/m/Y');
        $orarioArrivoMail=Carbon::parse($request->orarioArrivo)->format('H:i');
        
        $subject='Notifica di nuova Prenotazione';
        // Invia la mail al cliente
        $mailData = [
            'operazione' => 'effettuata',
            'title' => 'Notifica di nuova Prenotazione',
            'body' => 'È stata effettuata una nuova prenotazione sul sito Zenzero Holidays.',
            'nome' => $nome,
            'cognome' => $cognome,
            'telefono' => $telefono,
            'prezzoTotale' => $costoTotale,
            'arrivo' => $arrivoMail,
            'partenza' => $partenzaMail,
            'email' => $email,
            'stato' => $stato,
            'numAdulti' => $numAdulti,
            'numBambini' => $numBambini,
            'orario' => $orarioArrivoMail,
            'infoFinali' => 'Controlla il sistema per ulteriori dettagli e per gestire questa prenotazione. <br>
             È stata invita una mail di conferma all\'ospite con le coordinate bancarie per effettuare il pagamento.',
            'NomeSaluto' => 'Il Sistema di Notifiche '
        ];

        Mail::to('christian.zenzero@gmail.com')->send(new CustomMail($mailData, $subject));

        $subjectUtente='Conferma Prenotazione Zenzero Holidays';
        // Invia la mail al cliente
        $mailDataUtente = [
            'operazione' => 'effettuata',
            'title' => 'Notifica di nuova Prenotazione',
            'body' => 'Grazie per aver scelto Zenzero Holidays! La tua prenotazione è stata ricevuta con successo.',
            'nome' => $nome,
            'cognome' => $cognome,
            'telefono' => $telefono,
            'prezzoTotale' => $costoTotale,
            'arrivo' => $arrivoMail,
            'partenza' => $partenzaMail,
            'email' => $email,
            'stato' => $stato,
            'numAdulti' => $numAdulti,
            'numBambini' => $numBambini,
            'orario' => $orarioArrivoMail,
            'infoFinali' => 'Per confermare la tua prenotazione, ti preghiamo di effettuare il pagamento tramite bonifico bancario alle seguenti coordinate: <br>
            <ul>
            <li><strong>Intestatario:</strong> Zenzero Holidays</li>
            <li><strong>Banca:</strong> [Nome della Banca]</li>
            <li><strong>IBAN:</strong> [Inserisci IBAN]</li>
            <li><strong>Causale:</strong> Prenotazione </li>
            </ul>',
            'NomeSaluto' => 'Christian Girardelli'
        ];

        Mail::to($email)->send(new CustomMail($mailDataUtente, $subjectUtente));

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
        $prenotazione = $dl->findPrenotazioneById($id);

        $dl->deletePrenotazione($id);

        $arrivoMail= Carbon::parse($prenotazione->arrivo)->format('d/m/Y');
        $partenzaMail=Carbon::parse($prenotazione->partenza)->format('d/m/Y');
        $orarioArrivoMail=Carbon::parse($prenotazione->orarioArrivo)->format('H:i');

        $subject='Notifica di Cancellazione Prenotazione';

        // Invia la mail al cliente
        $mailData = [
            'operazione' => 'cancellata',
            'title' => 'Notifica di Cancellazione Prenotazione',
            'body' => 'La prenotazione dal ' . $arrivoMail . ' al ' . $partenzaMail . ' di ' . $prenotazione->nome . ' ' . $prenotazione->cognome . ' presso Zenzero Holidays è stata cancellata dall\'utente.',
            'nome' => $prenotazione->nome,
            'cognome' => $prenotazione->cognome,
            'telefono' => $prenotazione->telefono,
            'prezzoTotale' => $prenotazione->prezzoTotale,
            'arrivo' => $arrivoMail,
            'partenza' => $partenzaMail,
            'email' => $prenotazione->email,
            'stato' => $prenotazione->stato,
            'numAdulti' => $prenotazione->numAdulti,
            'numBambini' => $prenotazione->numBambini,
            'orario' => $orarioArrivoMail,
            'infoFinali' => 'Controlla se sono necessari eventuali aggiornamenti o rimborsi per questa cancellazione.',
            'NomeSaluto' => 'Il Sistema di Notifiche '
        ];

        Mail::to('christian.zenzero@gmail.com')->send(new CustomMail($mailData, $subject));

        return Redirect::to(route('prenotazioniUtente.index'))->with('success', __('messages.cancellation_success'));
    }


    public function showCalendar()
    {
        
        $dl = new DataLayer();
        $tariffe= $dl->listaTariffe();
        return view('pages.fullCalendar')->with('tariffe', $tariffe);
    }

    public function confermaPrenotazione($arrivo)
    {
        $arrivo= Carbon::parse($arrivo)->format('d-m-Y');
        $arrivoDopo = Carbon::parse($arrivo)->addDay()->format('d-m-Y');
        return view('utentePrenotazioni.confirmPrenotazione')->with(['arrivo'=> $arrivo, 'arrivoDopo'=> $arrivoDopo]);
    }
}
