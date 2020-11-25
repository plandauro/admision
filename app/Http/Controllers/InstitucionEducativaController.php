<?php

namespace App\Http\Controllers;
use App\InstitucionEducativa;
use Illuminate\Http\Request;

class InstitucionEducativaController extends Controller
{
    function getColegiosUbigeo($ubigeo)
    {
    	$colegios = InstitucionEducativa::colegiosUbigeo($ubigeo);
    	return response()->json(array('colegios'=>$colegios));
    }
}
