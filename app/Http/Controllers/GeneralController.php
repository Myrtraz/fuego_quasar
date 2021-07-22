<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tuupola\Trilateration\Intersection;
use Tuupola\Trilateration\Sphere;
use App\Modal\Satellites;

class GeneralController extends Controller
{

    public function topsecret(Request $request)
    {
        $input = $request->all();        

        $count = count($input['name']);
        $satellites = array();

        for($i=0; $i<$count; $i++){

           if(!empty($input['name'][$i])){
             array_push($satellites, 
             array(
              'satellites' => $input['name'][$i], $input['distance'][$i], $input['message'][$i]
             ));

           }
        }

        $arr= [$input['message'][0]];
        $arr1= [$input['message'][1]];
        $arr2= [$input['message'][2]];
        
        $list = array_merge($arr, $arr1, $arr2);
        
        $remove[] = "'";
        $remove[] = '"';
        $remove[] = "-";
        $remove[] = ",";
        $remove[] = " ";
        $FileName = str_replace( $remove, "",  $list);

        $z =  implode(" ", $FileName);
        dd($z);

        $sphere1 = new Sphere(-500.0, -200.0, $input['distance'][0]);
        $sphere2 = new Sphere(100.0, -100.0, $input['distance'][1]);
        $sphere3 = new Sphere(500.0, 100.0, $input['distance'][2]);
    
        $trilateration = new Intersection($sphere1, $sphere2, $sphere3);
        $point = $trilateration->position();

        //return $point;
    }

    public function topsecret_split_name(Request $request)
    {
      $input = $request->all();

      request()->satellite_name;
      
      $satellites = Satellites::create([
        'name' =>  request()->satellite_name,
        'distance' =>  $input['distance'],
        'message' =>  $input['message'],
      ]);

      return response()->json($satellites);
    }

    public function topsecret_split(Request $request)
    {  
      $id = 5;
      $id1 = 15;
      $id2 = 25;

      $satellite = Satellites::where('id', $id)->first();
      $satellite1 = Satellites::where('id', $id1)->first();
      $satellite2 = Satellites::where('id', $id2)->first();

        $arr= [$satellite->message];
        $arr1= [$satellite1->message];
        $arr2= [$satellite2->message];
        
        $list = array_merge($arr, $arr1, $arr2);
        
        $remove[] = "'";
        $remove[] = '"';
        $remove[] = "-";
        $remove[] = ",";
        $remove[] = " ";
        $FileName = str_replace( $remove, "",  $list);

        $z =  implode(" ", $FileName);

        dd($z);
      $sphere1 = new Sphere(-500.0, -200.0, $satellite->distance);
      $sphere2 = new Sphere(100.0, -100.0, $satellite1->distance);
      $sphere3 = new Sphere(500.0, 100.0, $satellite2->distance);

      //$sphere1 = new Sphere(60.1695, 24.9354, 81175);
      //$sphere2 = new Sphere(58.3806, 26.7251, 162311);
      //$sphere3 = new Sphere(58.3859, 24.4971, 116932);
      $trilateration = new Intersection($sphere1, $sphere2, $sphere3);
      $point = $trilateration->position();

      print_r($point);

      /*
      Tuupola\Trilateration\Point Object
      (
          [latitude:protected] => 59.418775152143
          [longitude:protected] => 24.75328717229
      )
      */

    $url = "https://appelsiini.net/circles/"
      . "?c={$sphere1}&c={$sphere2}&c={$sphere3}&m={$point}";

    print '<a href="{$url}">Open in map</a>';
      //return response()->json($satellites);
    }
}

/*
http://localhost:8000/api/topsecret?name[]=kenobi&distance[]=150
&message[]="este", "", "un", ""&name[]=skywalker&distance[]=200
&message[]="", "es", "un", ""&name[]=sato&distance[]=100
&message[]="", "es", "", "mensaje"

http://localhost:8000/api/topsecret_split/{nombre}

http://localhost:8000/api/topsecret_split
*/