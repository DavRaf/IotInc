<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\User;
use Session;
use Mail;

class AddUtenteController extends Controller
{
    public function index()
    {
    	//$users = DB::select('select * from users');
      return view('admin.addUtente');
    }

   /*public function accept($id) {
      User::where(['id'=>$id])->update(['AdminAcceptedStatus'=>'1']);
      //DB::update('update users set AdminAcceptedStatus = 1 where id = ?',[$id]);
      $users=DB::select('select * from users where id = ?',[$id]);
      foreach ($users as $user) {
          $email=$user->email;
      }
      Mail::send('admin.acceptingEmail', $users , function($message) use ($email) {

         $message->to($email)->subject
            ('Registrazione accettata da Iot Inc');
         $message->from('iotinctech@gmail.com');
      });
      Session::flash('status','Autorizzazione del cliente avvenuta con successo.');
      return redirect('admin/home/addUtente');
   }*/

   public function registerCliente(Request $request)
   {
      $user=new User;
      $this->validate($request,[
            'name'=> 'required|string|max:191',
            'lastname'=> 'required|string|max:191',
            'email'=> 'required|string|email|max:255|unique:users',
            'password'=> 'required|string|min:6|confirmed',
          ]);
      $user->name = $request->name;
      $user->lastname=$request->lastname;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->save();
      $email=$request->email;
      $password=$request->password;
      Mail::send('admin.registrationEmail', ['email' => $email, 'password' => $password] , function($message) use ($email) {

         $message->to($email)->subject
            ('Registrazione sulla piattaforma di Iot Inc');
         $message->from('iotIncTech@gmail.com');
      });
      Session::flash('status','Nuovo cliente registrato con successo.');
      return redirect()->route('addUtente');
   }

   public function __construct()
    {
        $this->middleware('auth:admin');
        //$this->middleware('admin');
    }
}
