<?php

namespace App\Http\Controllers;
use App\Ubigeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proceso = DB::table('proceso')
                    ->select('descripcion')
                    ->where('activo',"=",1)
                    ->get();

        $descripcion="";
        $array = json_decode($proceso);  
        foreach($array as $obj){
        $descripcion = $obj->descripcion;
        }  
        return view('index')->with('descripcion', $descripcion);
    }
    
   
}