<?php

namespace App\Http\Controllers;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AdminTariffeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dl=new DataLayer();
        $tariffe= $dl->listaTariffe();
        return view('adminTariffe.tariffe')->with('tariffe',$tariffe);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminTariffe.editTariffa');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Recupero dati inseriti nei campi della form per aggiunta nuova tariffa 
        $giorno = $request->input('giorno');
        $giornoFino = $request->input('giornoFino'); // Data finale dell'intervallo
        $prezzo = $request->input('prezzo');
        
        $dl = new DataLayer();
                
        // Converto le date in oggetti Carbon per facilitare l'iterazione
        $startDate = Carbon::parse($giorno);
        $endDate = Carbon::parse($giornoFino);

        // Itero su ogni giorno nell'intervallo
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            // Passo ogni giorno singolo all'addTariffa
            $dl->addTariffa($date->format('Y-m-d'), $prezzo);
        }

        return Redirect::to(route('tariffeAdmin.index'))->with('success', __('messages.rates_success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dl = new DataLayer();
        $tariffa = $dl->findTariffaById($id);

        if ($tariffa !== null) {
            return view('adminTariffe.detailsTariffa')->with('tariffa',$tariffa);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dl = new DataLayer();
        $tariffa = $dl->findTariffaById($id);
        
        if ($tariffa !== null) {
            return view('adminTariffe.editTariffa')->with('tariffa', $tariffa);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Recupero dati inseriti nei campi della form per aggiunta nuovo libro
        $giorno = $request->input('giorno');
        $prezzo= $request->input('prezzo');

        $dl = new DataLayer();
        $dl->editTariffa($id, $giorno, $prezzo);
        return Redirect::to(route('tariffeAdmin.index'))->with('success', 'Tariffe modificate con successo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dl = new DataLayer();
        $dl->deleteTariffa($id);

        return Redirect::to(route('tariffeAdmin.index'))->with('success', __('messages.ratesElim_success'));
    }

    public function confirmDestroy($id) {
        $dl = new DataLayer();
        $tariffa = $dl->findTariffaById($id);
        return view('adminTariffe.deleteTariffa')->with('tariffa', $tariffa);
    }

    public function ajaxCheckTariffa(Request $request) {
        
        $dl = new DataLayer();

        $giorno = $request->input('giorno');
        $giornoFino = $request->input('giornoFino');

        $tariffeTrovate=[];

        
        $tariffeTrovate= $dl->findTariffaByGiorno($giorno, $giornoFino);
          
        if ($tariffeTrovate->isNotEmpty()) {
            return response()->json(['found' => true, 'tariffe' => $tariffeTrovate]);
        }

        return response()->json(['found' => false]);
    }

    public function editGruppo()
    {
        $dl = new DataLayer();
        $dateRange = $dl->getDateRangeForTariffe(); // Supponendo un repository o data layer

        return view('adminTariffe.editTariffa')->with(['minDate' => $dateRange['minDate'],'maxDate' => $dateRange['maxDate']]);
    
    }

    public function updateGruppo(Request $request)
    {
    
       // Ottieni i dati dalla richiesta
        $giorno = $request->input('giorno');
        $giornoFino = $request->input('giornoFino');
        $prezzo = $request->input('prezzo');

        $dl = new DataLayer();
        $dl->editGruppoTariffe($giorno, $giornoFino, $prezzo);
        return Redirect::to(route('tariffeAdmin.index'));    
    }

    public function ajaxCheckTariffePrenotazioni(Request $request)
    {
        $giorno = $request->input('giorno');
        $giornoFino = $request->input('giornoFino');

        $dl = new DataLayer();
        $tariffePrenotate= $dl->checkTariffePrenotate($giorno, $giornoFino);
        

        return response()->json([
            'hasBookings' => $tariffePrenotate->isNotEmpty(),
            'bookedDays' => $tariffePrenotate
        ]);
    }
}