<?php

namespace App\Http\Controllers\Rilevazione;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Sensor;
use App\Measurement;
use App\Installation;
use Session;
use Charts;



class StoricoRilevazioniController extends Controller
{
    public function index()
    {
        $installations=Installation::where('idCliente',Auth::user()->id)->get();
        //return view('rilevazione.selectImpianto',compact('installations'));
        return view('rilevazione.selectImpianto',['installations' => $installations]);
    }

    public function graphs(Request $request)
    {
        $charts=array();
        $idImpianto=$request->impianto;
        $sensorsTypes =DB::table('sensors')->select('tipo')->join('installations','sensors.idImpianto','=','installations.id')->where('installations.idCliente','=',Auth::user()->id)->where('idImpianto','=',$idImpianto)->get();

        $charts[0] = Charts::database($sensorsTypes, 'pie', 'highcharts')

                  ->title("Numero di sensori nell'impianto per tipo")

                  ->elementLabel('Numero sensori')

                  ->dimensions(1000, 500)

                  ->responsive(true)

                  ->groupBy('tipo');




        $measurementsTroubles =DB::table('measurements')->join('sensors','sensors.id','=','measurements.idSensore')->where('valore','=',null)->where('idImpianto','=',$idImpianto)->get();

        $charts[1] = Charts::database($measurementsTroubles, 'bar', 'highcharts')

                  ->title('Numero di occasioni in cui i sensori sono risultati malfunzionanti(con Id del sensore)')

                  ->elementLabel('Numero volte')

                  ->dimensions(1000, 500)

                  ->responsive(true)

                  ->groupBy('idSensore');
       
        $tipiSensori=array();
        foreach ($sensorsTypes as $sensorsType) {
            if(in_array($sensorsType->tipo, $tipiSensori))
            {
                continue;
            }
                $tipiSensori[]=$sensorsType->tipo;
        }

        $avgTipo=array();
        foreach ($tipiSensori as $tipo) {
            $avg=DB::table('measurements')->join('sensors','sensors.id','=','measurements.idSensore')->where('idImpianto','=',$idImpianto)->where('tipo','=',$tipo)->avg('valore');
            $avgTipo[]=$avg;
        }
        
        
        $charts[2] = Charts::create('bar', 'highcharts')
                ->title('Media valori per tipo')
                ->elementLabel('Media valori rilevati')
                ->labels($tipiSensori)
                ->values($avgTipo)
                ->dimensions(1000,500)
                ->responsive(true);


        $measurementsTroublesNumber =DB::table('measurements')->join('sensors','sensors.id','=','measurements.idSensore')->where('valore','=',null)->where('idImpianto','=',$idImpianto)->count();

        $totalMeasurementsNumber =DB::table('measurements')->join('sensors','sensors.id','=','measurements.idSensore')->where('idImpianto','=',$idImpianto)->count();

        if($totalMeasurementsNumber > 0)
        {
            $percentagesErrors= bcdiv($measurementsTroublesNumber,$totalMeasurementsNumber,4)*100;

            $charts[3] = Charts::create('percentage', 'justgage')
                ->title('Percentuale malfunzionamenti')
                ->elementLabel('%')
                ->values([$percentagesErrors,0,100])
                ->responsive(true)
                ->height(300)
                ->width(0);
        }
        else
        {
            $charts[3] = Charts::create('percentage', 'justgage')
                ->title('Percentuale malfunzionamenti')
                ->elementLabel('%')
                ->values([0,0,100])
                ->responsive(true)
                ->height(300)
                ->width(0);
        }


        $totalMeasurementPerTipo=array();
        foreach ($tipiSensori as $tipo) {
            $total=DB::table('measurements')->join('sensors','sensors.id','=','measurements.idSensore')->where('idImpianto','=',$idImpianto)->where('tipo','=',$tipo)->count();
            $totalMeasurementPerTipo[]=$total;
        }
        
        
        $charts[4] = Charts::create('bar', 'highcharts')
                ->title('Totale rilevazioni effettuate per tipo')
                ->elementLabel('Numero Rilevazioni')
                ->labels($tipiSensori)
                ->values($totalMeasurementPerTipo)
                ->dimensions(1000,500)
                ->responsive(true);

        $sensors=DB::select('select * from sensors where idImpianto in ( select id from installations where id = ? and idCliente in ( select id from users where id = ?))',[$idImpianto,Auth::user()->id]);

            //return view('rilevazione.storico',compact('chart1'),compact('chart2'))->with('chart3',$chart3)->with('chart4',$chart4);
        return view('rilevazione.storico',['charts' => $charts])->with('sensors', $sensors);
        
    }

    public function graphSensore(Request $request)
    {
        $idSensore=$request->sensore;
        $charts=array();
        $sensorValues=DB::select('select valore from measurements where idSensore = ?',[$idSensore]);
        $values=array();
        $count=0;
        foreach ($sensorValues as $sensorValue) {
            if($sensorValue->valore === null)
            {
                continue;
            }
            $values[]=$sensorValue->valore;
            $count++;
        }
        $labels=array();
        for($i=1;$i<=$count;$i++)
        {
            $labels[] = 'Rilevazione numero ' . $i . '' ;
        }
        $charts[0]=Charts::create('line', 'highcharts')
                ->title('Storico sensore')
                ->elementLabel('Valore')
                ->values($values)
                ->labels($labels)
                ->dimensions(1000,500)
                ->responsive(true);

        return view('rilevazione.storicoSensore',['charts' => $charts]);
    }

    

}
