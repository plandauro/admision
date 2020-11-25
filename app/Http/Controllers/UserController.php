<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Response;
use App\User;
use Illuminate\Support\Facades\Auth;
use DB;
use Hash;

class UserController extends Controller
{
    public function saveFoto(Request $request)
    {

        $dni = DB::table('users')
                    ->select('dni')
                    ->where('id',"=",$request->iduser)
                    ->get();

        $array = json_decode($dni);  
        foreach($array as $obj){
        $dni1 = $obj->dni;
        } 

    	$messages = [
    		'image.image' => 'El archivo seleccionado debe ser una imagen.',
    		'image.mimes' => 'La imagen debe tener formato jpg.',
    		'iduser.required' => 'Se necesita el c贸digo de usuario.',
    		'iduser.exists' => 'C贸digo de usuario incorrecto.'
    	];
		$validator = Validator::make($request->all(),[
			'image' => 'image|mimes:jpeg,jpg',
			'iduser' => 'required|exists:users,id'
		], $messages)->validate();

		$file = $request->image;
		$destinationPath = 'images/users/';
		$ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
		$filename = $dni1.".".$ext;
		$request->image->move($destinationPath, $filename);
		$src = $destinationPath.$filename;

		$user = User::find($request->iduser);
		$user->foto = $src;
		if ($user->save()) 
			return Response::json(['success' => true, 'file' => $src]);
    }

    private function recortar(String $src, int $x, int $y, int $w, int $h)
	{
		$targ_w = $targ_h = 200;
		$jpeg_quality = 90;	
		$img_r = imagecreatefromjpeg($src);
		$dst_r = ImageCreateTrueColor($targ_w, $targ_h);

		imagecopyresampled($dst_r , $img_r , 0 , 0 , $x , $y , $targ_w , $targ_h , $w , $h );
		imagejpeg($dst_r,$src,$jpeg_quality);
		//exit;
	}

    public function changepassword(Request $request)
    {

        $passwordBD = DB::table('users')
                    ->select('password')
                    ->where('id',"=",$request->iduser)
                    ->get();

        $array = json_decode($passwordBD);  
        foreach($array as $obj){
        $passwordBD1 = $obj->password;
        } 
        $citas = User::find($request->iduser);
        $flag=bcrypt($request->oldpassword);
        $newpassword=bcrypt($request->newpassword);
        $citas->password=$newpassword;
        //$citas->save();
        if (Hash::check($request->oldpassword, $passwordBD1)) {

            if($request->newpassword==$request->passwordrepeat){
            if($passwordBD1==$request->oldpassword1){
            $citas->save();
            $correcto="SE CAMBIO CORRECTAMENTE LA CONTRASEÑA";
          return Response::json(['success' => true]);

            }else{
            $correcto3="CONTRASEÑA ANTERIOR INCORRECTA.";
          //  return response()->json(['mensaje' => $correcto3,'type' =>'alert-danger','success' => true]);
                     			return Response::json(['success' => false]);

            }
        }else{
            $correcto4="LA CONTRASEÑA NO COINCIDE, VUELVA A ESCRIBIR.";
           			return Response::json(['success' => 'no']);

        }
        }else{
            $correcto5="CONTRASEÑA ANTERIOR INCORRECTA.";
           // return response()->json(['mensaje' => $correcto5,'type' =>'alert-danger','success' => true]);
           return Response::json(['success' => false]);
        }

    }
}
