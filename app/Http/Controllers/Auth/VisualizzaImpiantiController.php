<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class VisualizzaImpiantiController extends Controller
{
    public function list()
    {
    	$idCliente= Auth::user()->id;
    	$installations= DB::select('select * from installations where idCliente = ?',[$idCliente]);
        //return view('auth.installationsList',compact('installations'));
        return view('auth.installationsList',['installations' => $installations]);
    }
    

    public function show($id)
    {
        $installations =DB::select('select * from installations where id = ?',[$id]);
        $sensors=DB::select('select * from sensors where idImpianto = ?',[$id]);
        return view('auth.installationShow',['sensors' => $sensors],['installations' => $installations]);
    }

    
}
