<?php

namespace App\Http\Controllers;
use App\Usuarios;
use Illuminate\http\Request;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuario = Usuarios::all();
        return response()->json([$usuario],200);
    }
    
    public function guadar_usuario(Request $request)
    {
        if($request->isMethod('post')){ 
            $data = $request->all();
            $user = Usuarios::create([
                "nombre"=>$data["nombre"],
                "edad"=>$data["edad"],
                "sexo"=>$data["sexo"],
                "token"=> Str::random(32),
            ]);
            return response()->json([$user],201);
        }else{ 
            return response()->json(["error"=>"Con un demonio lo que faltaba"],401);
        }
    }
}
