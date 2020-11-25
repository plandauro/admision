<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poblacion extends Model
{
    protected $table = 'poblacion';

    public $rules = [
	    	'apepaterno' => 'required|min:3|max:255',
            'apematerno' => 'required|min:3|max:255',
            'nombres' => 'required|min:3|max:255',
            'fechanacimiento' => 'required|date',
            'tipodocumento' => 'required|integer|between:1,4',
            'numerodocumento' => 'required|size:8',
            'parentescojefe' => 'required|integer|between:1,11',
            'sexo' => 'required|in:M,F',
            'gestante' => 'required_if:sexo,"F"',
            'estadocivil' => 'required|integer|between:1,6',
            'seguroessalud' => 'nullable|between:0,1',
            'segurofapnp' => 'nullable|between:0,1',
            'seguroprivado' => 'nullable|between:0,1',
            'segurosis' => 'nullable|between:0,1',
            'segurootro' => 'nullable|between:0,1',
            'idiomaninez' => 'required|integer|between:1,7',
            'sabeleer' => 'required|between:0,1',
            'niveleducativo' => 'required|integer|between:1,7',
            'ultimogrado' => 'required|integer|between:1,6',
            'ocupacionultimomes' => 'required|integer|between:1,10',
            'sector' => 'required|integer|between:1,10',
            'discapacidadvisual' => 'nullable|between:0,1',
            'discapacidadoir' => 'nullable|between:0,1',
            'discapacidadhablar' => 'nullable|between:0,1',
            'discapacidadusarbrazos' => 'nullable|between:0,1',
            'discapacidadmental' => 'nullable|between:0,1',
            'vasoleche' => 'nullable|between:0,1',
            'comedorpopular' => 'nullable|between:0,1',
            'comidaescolar' => 'nullable|between:0,1',
            'papilla' => 'nullable|between:0,1',
            'canastaalimentaria' => 'nullable|between:0,1',
            'juntos' => 'nullable|between:0,1',
            'techopropio' => 'nullable|between:0,1',
            'pension' => 'nullable|between:0,1',
            'cunamas' => 'nullable|between:0,1',
            'otros' => 'nullable|between:0,1',
					];
	public $messages = [
					'apepaterno.required' => 'Se requiere el apellido paterno.',
		            'apepaterno.min' => 'Asegurese de escribir correctamente el apellido paterno.',
		            'apematerno.required' => 'Se requiere el apellido materno.',
		            'apematerno.min' => 'Asegurese de escribir correctamente el apellido materno.',
		            'nombres.required' => 'Se requieren los nombres.',
		            'nombres.min' => 'Asegurese de escribir correctamente los nombres.',
		            'fechanacimiento.required' => 'Se requieren la fecha de nacimiento.',
		            'fechanacimiento.date' => 'El formato de la fecha de nacimiento no es correcto.',
		            'tipodocumento.required' => 'Seleccione el tipo de documento.',
		            'tipodocumento.between' => 'El del tipo de documento no es el correcto.',
		            'numerodocumento.required' => 'Se requiere el número de documento',
		            'numerodocumento.size' => 'El número de documento debe contener 8 caracteres',
		            'parentescojefe.required' => 'Seleccione el parentesco con el jefe de hogar.',
		            'sexo.required' => 'Seleccione el sexo.',
		            'gestante.required_if' => 'Seleccione si es gestante o no.',
		            'estadocivil.required' => 'Seleccione el estado civil.',
		            'idiomaninez.required' => 'Seleccione idioma.',
		            'sabeleer.required' => 'Seleccione si sabe leer.',
		            'niveleducativo.required' => 'Seleccione el nivel educativo.',
		            'ultimogrado.required' => 'Seleccione el ultimo año aprobado.',
		            'ocupacionultimomes.required' => 'Seleccione la ocupación del ultimo mes.',
		            'sector.required' => 'Seleccione el sector en el que se desempeña.',
					];
}
