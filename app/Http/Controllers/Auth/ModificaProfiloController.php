<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use App\User;
use Auth;
use Session;


class ModificaProfiloController extends Controller
{
    public function index()
    {
    	return view('auth.modificaProfilo');
    }

    public function edit(Request $request,$id)
    {
    	$user=User::find($id);
    	$this->validate($request,[
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
    	]);
    	$user->email=$request->email;
    	$user->password=Hash::make($request->password);
    	$user->save();
    	Session::flash('status','Credenziali aggiornate con successo.');
    	return redirect('/home');
    }
}
