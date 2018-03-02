<?php

namespace App\Http\Controllers\Sensore;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class VisualizzaMalfunzionamentiController extends Controller
{
    public function show()
    {
    	$sensors=DB::select('select * from sensors where id in (select idSensore from measurements where codiceErrore is not null)');
    	return view('sensore.visualizzaMalfunzionamenti',['sensors' => $sensors]);
    }

    public function showDetails($idSensore)
    {
    	$errors=DB::select('select * from error_handlers where codice in (select codiceErrore from measurements where idSensore = ?)',[$idSensore]);
    	return view('sensore.visualizzaDettagliMalfunzionamento',['errors' => $errors]);
    }

    public function __construct()
    {
        $this->middleware('auth:admin');
        //$this->middleware('admin');
    }
}
