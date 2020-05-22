<?php

namespace App\Http\Controllers;
use App\Ciudades;
use Illuminate\http\Request;
use Illuminate\Support\Facades\DB;
class CiudadesController extends Controller
{
    public function index()
    {
        $usuario = Ciudades::all();
        return response()->json([$usuario],200);
    }
    public function sugerencias(Request $request)
    {

        if($request->isMethod('get')){ 
            $data = $request->all();
            $results = DB::select('SELECT name,latitude,longitude FROM ciudades WHERE ansiname LIKE "%'.$data["q"].'%" LIMIT 100');
            return response()->json(["suggestions" => $results]);
        }else{ 
            return response()->json(["error"=>"Con un demonio lo que faltaba"],401);
        }
    }
}
