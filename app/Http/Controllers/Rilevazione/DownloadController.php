<?php

namespace App\Http\Controllers\Rilevazione;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Measurement;
use Response;

class DownloadController extends Controller
{
    public function esporta($numeroRilevazione)
    {
    	$measurement = Measurement::where('numero',$numeroRilevazione)->get();
		$csvExporter = new \Laracsv\Export();
		$csvExporter->build($measurement, ['numero', 'idSensore','data','ora','valore','codiceErrore','descrizione'])->download();
    }

    public function esportaTutto()
    {
    	$measurement = Measurement::all();
		$csvExporter = new \Laracsv\Export();
		$csvExporter->build($measurement, ['numero', 'idSensore','data','ora','valore','codiceErrore','descrizione'])->download();
    }

    
}

	
