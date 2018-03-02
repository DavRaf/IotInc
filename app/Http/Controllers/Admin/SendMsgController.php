<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Session;

class SendMsgController extends Controller
{
    public function index($email)
    {
    	return view('admin.sendMsg',['email' => $email]);
    }

    public function exec(Request $request,$email)
    {
    	$msg=$request->msg;
    	$email=$email;
    	Mail::send('admin.sendEmail', ['msg' => $msg], function($message) use ($email) {

        $message->to($email)->subject('Amministratore Iot Inc');
        $message->from('iotinctech@gmail.com');
      	});
        Session::flash('status','Messaggio inviato con successo!');
      	return redirect()->route('visualizzaClienti');
    }

     public function __construct()
    {
        $this->middleware('auth:admin');
        //$this->middleware('admin');
    }
}
