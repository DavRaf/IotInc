<?php

namespace App\Http\Controllers\Sensore;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sensor;
use App\Installation;
use Session;

class SensoreCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sensors= Sensor::all();
        //return view('sensore.home',compact('sensors'));
        return view('sensore.home',['sensors' => $sensors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $installations=Installation::all();
        //return view('sensore.create',compact('installations'));
        $count=Installation::all()->count();
        if($count === 0)
        {
            return view('denied');
        }
        else
        {
         return view('sensore.create',['installations' => $installations]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $sensore=new Sensor;
        $this->validate($request,[
            'marca'=> 'required|string|max:191',
            'tipo'=> 'required|string|max:191',
            'modello'=> 'required|string|max:191',
            'codice'=> 'required|string|max:191',
            'descrizione'=> 'nullable|max:191',
            ]);
        $sensore->marca = $request->marca;
        $sensore->tipo = $request->tipo;
        $sensore->modello = $request->modello;
        $sensore->codice = $request->codice;
        $sensore->descrizione = $request->descrizione;
        //$sensore->unitaMisura = $request->unitaMisura;
        $sensore->idImpianto=$request->impianto;
        $sensore->save();
        Session::flash('status','Nuovo sensore aggiunto con successo.');
        return redirect()->route('sensoreCRUD.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sensor=Sensor::find($id);
        $installations=Installation::all();
        //return view('sensore.edit',compact('sensor'),compact('installations'));
        return view('sensore.edit',['sensor' => $sensor],['installations' => $installations]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sensore= Sensor::find($id);
        $this->validate($request,[
            'marca'=> 'required|string|max:191',
            'tipo'=> 'required|string|max:191',
            'modello'=> 'required|string|max:191',
            'codice'=> 'required|string|max:191',
            'descrizione'=> 'nullable|max:191',
            ]);
        $sensore->marca = $request->marca;
        $sensore->tipo = $request->tipo;
        $sensore->modello = $request->modello;
        $sensore->codice = $request->codice;
        $sensore->descrizione = $request->descrizione;
        $sensore->idImpianto=$request->impianto;
        $sensore->save();
        Session::flash('status','Sensore modificato con successo.');
        return redirect()->route('sensoreCRUD.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sensor=Sensor::find($id);
        $sensor->delete();
        Session::flash('status','Sensore eliminato con successo.');
        return redirect()->route('sensoreCRUD.index');
    }

    public function cambiaStato($idSensore,$statoSensore)
    {
        switch ($statoSensore) {
            case 'attivo':
                Sensor::where(['id'=>$idSensore])->update(['stato'=>'disabilitato']);
                break;
            case 'disabilitato':
                Sensor::where(['id'=>$idSensore])->update(['stato'=>'attivo']);
                break;
            default:
                return redirect()->back();
        }
        /*if($statoSensore === 'attivo')
            Sensor::where(['id'=>$idSensore])->update(['stato'=>'disabilitato']);
        elseif($statoSensore === 'disabilitato')
            Sensor::where(['id'=>$idSensore])->update(['stato'=>'attivo']);
        else
            return redirect()->back();*/
        return redirect()->back();
    }

    public function __construct()
    {
        $this->middleware('auth:admin');
        //$this->middleware('admin');
    }
}
