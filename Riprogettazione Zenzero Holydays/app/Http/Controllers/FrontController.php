<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function getHome()
    {
        return view('index');
    }

    public function getCasaVacanze()
    {
        return view('pages.casaVacanze');
    }

    public function getLuoghiDiInteresse()
    {
        return view('pages.luoghiDiInteresse');
    }

    public function getPrenotazioni()
    {
        return view('pages.confermaPrenotazione');
    }

    public function getContatti()
    {
        return view('pages.contatti');
    }
   
    
    
}
