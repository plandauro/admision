<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMail;

class CorreoController extends Controller
{
   


  /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
    }


   public function crear()
    {

        return view("emails.form_mail");
        

    }



     public function enviar(Request $request)
    {
    
   $pathToFile="";
    $containfile=false; 
    if($request->hasFile('archivo_oculto4') ){

       $containfile=true; 
     
       $archivo =$request->file('archivo_oculto4');
        $nombreOriginal= $archivo->getClientOriginalName();
        $extension = $archivo->getClientOriginalExtension();
        $rl = \Storage::disk('archivos')->put($nombreOriginal, \File::get($archivo));
        $ruta = storage_path('archivos').'/'.$nombreOriginal;
   

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
        if($request->hasFile('file') ){ 
         
      
        $archivo =$request->file('file');
        $nombreOriginal= $archivo->getClientOriginalName();
        $extension = $archivo->getClientOriginalExtension();
        $rl = \Storage::disk('archivos')->put($nombreOriginal, \File::get($archivo));
        $ruta = storage_path('archivos').'/'.$nombreOriginal;




         } 
         else{

            return "no";
         } 

        if($r){
            return $nombre ;
        }
        else
        {
            return "error vuelva a intentarlo";
        }
      
         
    }

    
  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
