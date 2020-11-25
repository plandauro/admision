<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Materia;
use App\Proceso;
use Illuminate\Support\Facades\Auth;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
        return view('mantenimiento.materia');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function listaMaterias(){
      $materia = Materia::select('id', 'nombre','estado')
                ->where('estado','=','1')->get();
      return response()->json(['postulaciones' => $materia]);
    }  

    public function actualizarMaterias(Request $request){      
      $materia=Materia::where('id', '=', $request->codigo)->first();
      if(count($materia)>=1){
        $materia->nombre=$request->descripcion;
        $materia->save();
      }
    }

    public function crearMaterias(Request $request){      
        $materia= new Materia();
        $materia->nombre=$request->descripcion;
        $materia->estado=1;
        $materia->save();
    }

     public function eliminarMaterias(Request $request){      
      $materia=Materia::where('id', '=', $request->codigo)->first();
      if(count($materia)>=1){
        $materia->estado=0;
        $materia->save();
      }
    }    

}
