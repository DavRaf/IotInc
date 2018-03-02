<?php

namespace App\Http\Controllers\Rilevazione;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Measurement;
use Session;
use Mail;

class SimulaRicezioneRilevazioneController extends Controller
{
    public function index()
    {
    	return view('rilevazione.home');
    }

    public function execute()
    {   
        //$count=DB::select('select * from installations where idCliente = ?',[Auth::user()->id])->count();
        $countInstallations = DB::table('installations')->where('idCliente', '=', Auth::user()->id)->count();
        $countSensors = DB::table('sensors')->join('installations','sensors.idImpianto','=','installations.id')->where('installations.idCliente','=',Auth::user()->id)->count();
        if($countInstallations > 0 && $countSensors > 0){
    	   $stringaRilevazione = $this->getStringaRilevazione();
           if($stringaRilevazione === null)
           {
                Session::flash('statusErr','Attenzione! Non sono presenti sensori attivi.');
                return redirect()->route('simulaRicezioneRilevazione.index');
           }
           
    	   $parts = explode(' ', $stringaRilevazione);
		   $rilevazione=new Measurement;
           $count=intval(count($parts));
           if($count === 3){
                $rilevazione->stringaRilevazione = $stringaRilevazione;
                $rilevazione->idSensore=$parts[0];
                $rilevazione->codiceErrore=$parts[1];
                $rilevazione->descrizione=$parts[2];
                $rilevazione->save();
                Session::flash('statusNO','Attenzione! Ricevuto codice di errore che potrebbe indicare un malfunzionamento del sensore.');
            }
           else
           {
		        $rilevazione->stringaRilevazione = $stringaRilevazione;
		        $rilevazione->idSensore=$parts[0];
		        $rilevazione->data=$parts[1];
		        $rilevazione->ora=$parts[2];
		        $rilevazione->valore=$parts[3];
                $parts[4] = str_replace('£', '  ', $parts[4]);
		        $rilevazione->descrizione=$parts[4];
		        $rilevazione->save();
                Session::flash('statusOK','Rilevazione ricevuta e memorizzata con successo.');
            }
            //$data = array('rilevazioni'=>$rilevazioni);
            $rilevazione=Measurement::where(['stringaRilevazione' => $stringaRilevazione])->get()->first();
   	  		$email=Auth::user()->email;;
            Mail::send('rilevazione.mailAutomatica', ['rilevazione' => $rilevazione], function($message) use ($email) {

         	$message->to($email)->subject('Rilevazione effettuata Iot Inc');
         	$message->from('iotinctech@gmail.com');
      		});
		    return redirect()->route('simulaRicezioneRilevazione.index');
        }
        else
        {
            Session::flash('statusErr',"Non puoi effettuare rilevazioni se non sono presenti impianti e\o sensori appartenenti all'impianto\i stesso\i.");
            return redirect()->route('simulaRicezioneRilevazione.index');
        }
    
    }

    private function getStringaRilevazione()
    {
    	$idCliente=Auth::user()->id;
    	$idSensori=array();
    	$sensori=DB::select("select id from sensors where stato = \"attivo\" and idImpianto in ( select id from installations where idCliente = ?)",[$idCliente]);
    	foreach ($sensori as $sensore) {
    		$idSensori[]=$sensore->id;
    	}
        if(count($idSensori) === 0)
        {
            return null;
        }
        else
        {
    	$idSensore = $idSensori[array_rand($idSensori)];
    	//$id=strval($id);
    	
        $flag=rand(0,20);
        switch ($flag) {
            case 0: case 1: case 2:
                $codiceErrore=$this->getCodiceErrore();
                $errore=$codiceErrore->codice;
                $description=$codiceErrore->descrizione;
                $description = str_replace(' ', '', $description);
                return $idSensore  . ' ' . $errore . ' ' . $description;
            default:
                
                $date = $this->getRandomDate();
                $time = $this->getRandomTime();
                /*switch ($unitaMisura) {
                	case 'Temperatura':
                		$value=rand(-20,60);
                		break;
                	case 'Infrarossi': case 'Radiazione':
                		$value=rand(1,4)/100;
                		break;
                	default:
                		$value=rand(0,100);
                }*/
                $value=rand(-10,60);
                $description='Il£sensore£'.$idSensore. '£ha£rilevato£il£valore£di£'.$value.'£alle£ore£'.$time.'£in£data£'.$date;
                $description = str_replace(' ', '', $description);
                return $idSensore  . ' ' . $date . ' ' . $time . ' ' . $value . ' ' . $description;
            }
        }
    }

    public function getRandomTime()
    {
        //return mt_rand(0,23).':'.str_pad(mt_rand(0,59), 2, '0', STR_PAD_LEFT);
        return date('G:i');
    }

    public function getRandomDate()
    {
        /*
        $years=array('2016','2017');
        $year= $years[array_rand($years)];
        $month= mt_rand(1, 12);
        $day= mt_rand(1, 28);
        return $day . '-' . $month . '-' . $year;
        */
        return date ('d/m/Y');
    }

    public function getCodiceErrore()
    {
        /*$countRows=DB::table('error_handlers')->count();
        $countRows=intval($countRows);
        if($countRows === 0)
        {
            DB::statement('INSERT INTO error_handlers ( codice , descrizione , causa ) VALUES ( E400, Errore collettore polvere
            , Guasto collettore polvere o elemento sporco ), ( E500, Microprocessore scheda elettronica non funzionante
            ,Guasto scheda elettronica o fattore esterno (rumore
            ecc.) )');
        }
        else
        {*/
        $codiciErrori=array();
        $errori=DB::select('select * from error_handlers');
        foreach ($errori as $errore) {
            $codiciErrori[]=$errore;
        }
        $codiceErrore = $codiciErrori[array_rand($codiciErrori)];
        return $codiceErrore;
        //}
    }


}
