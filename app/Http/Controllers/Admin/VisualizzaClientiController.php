<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use Session;

class VisualizzaClientiController extends Controller
{
    public function index(){
      $users = DB::select('select * from users');
      return view('admin.visualizzaClienti',['users'=>$users]);
   }
   public function destroy($id) {
      DB::delete('delete from users where id = ?',[$id]);
      Session::flash('status','Cliente eliminato con successo.');
      return redirect('admin/home/visualizzaClienti');
   }

   public function __construct()
    {
        $this->middleware('auth:admin');
        //$this->middleware('admin');
    }
}
