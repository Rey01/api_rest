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
            $results = DB::select('SELECT name,latitude,longitude FROM ciudades WHERE ansiname LIKE "%'.$data["q"].'%" LIMIT 20');

            $ciudades = $this->obetner_score($results,$data["q"]);
            
            return response()->json(["suggestions" => $ciudades]);
        }else{ 
            return response()->json(["error"=>"Con un demonio lo que faltaba"],401);
        }
    }
    
    public function name_comparison($city_name,$query,$lat,$lng){
        $namearr = $city_name;
        $queryarr = $query;
        $distance = $this->getEditDistance($city_name,$query);
        $score = $lat && $lng ? ((strlen($namearr) - $distance)/strlen($namearr))/2 : ((strlen($namearr) - $distance)/strlen($namearr));
        return $score ;
    }
      
      // Algorithm that calculates the difference between 2 strings(Levenshtein distance)
      public function getEditDistance($a, $b){
        if(strlen($a) == 0) return strlen($b);
        if(strlen($b) == 0) return strlen($a);
        $matrix = [];
        for($i = 0; $i <= strlen($b); $i++){
          $matrix[$i] = [$i];
        }
        for($j = 0; $j <= strlen($a); $j++){
          $matrix[0][$j] = $j;
        }
        for($i = 1; $i <= strlen($b); $i++){
          for($j = 1; $j <= strlen($a); $j++){
            if(substr($b,($i-1),1) == substr($a,($j-1),1)){
              $matrix[$i][$j] = $matrix[$i-1][$j-1];
            } else {
              $matrix[$i][$j] = min($matrix[$i-1][$j-1] + 1, // substitution
                                      min($matrix[$i][$j-1] + 1, // insertion
                                               $matrix[$i-1][$j] + 1)); // deletion
            }
          }
        }
        return ($matrix[strlen($b)][strlen($a)]); // returns an integer,0 if strings are identical n if they are not nE(0,+infinite)
      }
    
    function obetner_score($ciudades,$query){
        $array_ciudades_new=array();
        $array_scores = array();
        foreach ($ciudades as $ciudad) {
            $score = $this->name_comparison($ciudad->name,$query,$ciudad->latitude,$ciudad->longitude);

            $array_ciudades_new[] = array(
                "name" =>$ciudad->name,
                "latitude" =>$ciudad->latitude,
                "longitude" =>$ciudad->longitude,
                "score" =>$score
            );
            $array_scores[] =$score;
        }
        array_multisort($array_scores, SORT_DESC, $array_ciudades_new);
        return $array_ciudades_new;
      
    }
}
