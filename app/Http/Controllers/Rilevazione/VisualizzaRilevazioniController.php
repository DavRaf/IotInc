<?php

namespace App\Http\Controllers\Rilevazione;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Measurement;
use App\Installation;

class VisualizzaRilevazioniController extends Controller
{
    public function selectImpianto()
    {
        $installations = Installation::where('idCliente',Auth::user()->id)->get();
        return view('rilevazione.selectImpiantoRilevazioni',['installations' => $installations]);
    }

    public function selectSensore(Request $request)
    {
        $idImpianto = $request->impianto;
        $sensors = DB::select('select * from sensors where idImpianto = ?',[$idImpianto]);
        return view('rilevazione.selectSensoreRilevazioni',['sensors' => $sensors]);
    }

    public function list(Request $request)
    {
    	//$idCliente= Auth::user()->id;
        $idSensore= $request->sensore;
    	$measurements=DB::select('select * from measurements where idSensore = ?',[$idSensore]);
        //return view('rilevazione.measurementsList',compact('measurements'));
        return view('rilevazione.measurementsList',['measurements' => $measurements]);
    }

    public function show($numero)
    {
        $measurements = DB::select('select * from measurements where numero = ?',[$numero]);
        foreach ($measurements as $measurement) {
            $idSensore=$measurement->idSensore;
        }
        $sensors=DB::select('select * from sensors where id = ?',[$idSensore]);
        return view('rilevazione.measurementShow',['measurements' => $measurements],['sensors' => $sensors]);
    }

    
}
