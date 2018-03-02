<?php

namespace App\Http\Controllers\Rilevazione;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Mail;
use Session;
use Auth;

class CondividiRilevazioneController extends Controller
{
    public function index($id)
    {
    	return view('rilevazione.condividi',['id' => $id]);
    }

    public function sendEmail(Request $request,$numeroRilevazione)
    {
   	  $rilevazioni=DB::select('select * from measurements where numero = ?',[$numeroRilevazione]);
   	  $data = array('rilevazioni'=>$rilevazioni);
   	  $email=$request->email;
      Mail::send('rilevazione.mail', $data, function($message) use ($email) {

         $message->to($email)->subject
            ('Rilevazione effettuata Iot Inc');
         $message->from(Auth::user()->email,Auth::user()->name . ' ' . Auth::user()->lastname);
      });
      Session::flash('status','Email inviata con successo.');
      return redirect()->route('visualizzaRilevazioni.list');
    }

    
}
