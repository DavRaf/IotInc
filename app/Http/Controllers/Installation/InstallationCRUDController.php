<?php

namespace App\Http\Controllers\Installation;

use Illuminate\Http\Request;
use App\Installation;
use App\User;
use App\Sensor;
use App\Composition;
use App\Http\Controllers\Controller;
use Session;
use DB;


class InstallationCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $installations= Installation::all();
        //return view('impianto.home',compact('installations'));
        return view('impianto.home',['installations' => $installations]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::all();
        $count=User::all()->count();
        if($count === 0)
        {
            return view('denied');
        }
        else
        {
            return view('impianto.create',['users' => $users]);
        }
        //return view('impianto.create',compact('users'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $impianto=new Installation;
        $this->validate($request,[
            'sitoMonitoraggio'=> 'required|string|max:191',
            'descrizione'=> 'nullable|max:191',
            'citta'=> 'nullable|max:191',
            'indirizzo'=> 'nullable|max:191',
            ]);
        $impianto->sitoMonitoraggio = $request->sitoMonitoraggio;
        $impianto->idCliente=$request->user;
        $impianto->citta = $request->citta;
        $impianto->indirizzo = $request->indirizzo;
        $impianto->descrizione = $request->descrizione;
        $impianto->save();
        Session::flash('status','Nuovo impianto aggiunto con successo.');
        return redirect()->route('installationCRUD.addSensore',[$impianto->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$installation=DB::table('installations')->where('id', $id)->first();
        $installations =DB::select('select * from installations where id = ?',[$id]);
        $users=DB::select('select * from users where id in(select idCliente from installations where id = ?)',[$id]);
        $sensors=DB::select('select * from sensors where idImpianto = ?',[$id]);
        return view('impianto.show',['users' => $users],['installations' => $installations])->with('sensors',$sensors);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users=User::all();
        $installation=Installation::find($id);
        //return view('impianto.edit',compact('installation'),compact('users'));
        return view('impianto.edit',['installation' => $installation],['users' => $users]);
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
        $impianto= Installation::find($id);
        $this->validate($request,[
            'sitoMonitoraggio'=> 'required|string|max:191',
            'descrizione'=> 'nullable|max:191',
            'citta'=> 'nullable|max:191',
            'indirizzo'=> 'nullable|max:191',
            ]);
        $impianto->sitoMonitoraggio = $request->sitoMonitoraggio;
        $impianto->idCliente=$request->user;
        $impianto->citta = $request->citta;
        $impianto->indirizzo = $request->indirizzo;
        $impianto->descrizione = $request->descrizione;
        $impianto->save();
        return redirect()->route('installationCRUD.listSensori',['id' => $impianto->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $installation=Installation::find($id);
        $installation->delete();
        Session::flash('status','Impianto eliminato con successo.');
        return redirect()->route('installationCRUD.index');
    }

    public function addSensore($id)
    {
        return view('impianto.addSensore')->with('id',$id);
    }

    public function storeSensore(Request $request,$idImpianto)
    {
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
        $sensore->idImpianto=$idImpianto;
        $sensore->save();
        Session::flash('status','Nuovo sensore aggiunto con successo.');
        return view('impianto.confirm',['idImpianto' => $sensore->idImpianto]);
    }

    public function listSensori($id)
    {
        $sensors=DB::select('select * from sensors where idImpianto = ?',[$id]);
        //return view('impianto.listSensori',compact('sensors'))->with('id',$id);
        return view('impianto.listSensori',['sensors' => $sensors])->with('id',$id);
    }

    public function editSensore($idSensore)
    {
        $sensor=Sensor::find($idSensore);
        //return view('impianto.editSensore',compact('sensor'))->with('id',$id);
        return view('impianto.editSensore',['sensor' => $sensor])->with('id',$id);
    }


    public function __construct()
    {
        $this->middleware('auth:admin');
        //$this->middleware('admin');
    }
}
