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
        $d = array();
        $p = array(
            array($input['satellites'][0]['message']),
            array($input['satellites'][1]['message']),
            array($input['satellites'][2]['message'])
        );

        $count = count($p);
        for ($i= 0; $i<$count; $i++) {

            for ($o= 0; $o < count(array($i)) ; $o++) {
                $d[] = $p[$i][$o];


            }
        }

        dd($d[0][3]);

        $sphere1 = new Sphere(-500.0, -200.0, $input['satellites'][0]['distance']);
        $sphere2 = new Sphere(100.0, -100.0, $input['satellites'][1]['distance']);
        $sphere3 = new Sphere(500.0, 100.0, $input['satellites'][2]['distance']);

        $trilateration = new Intersection($sphere1, $sphere2, $sphere3);
        $point = $trilateration->position();

        dd($point);

        return response()->json($point, $d);
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

      $trilateration = new Intersection($sphere1, $sphere2, $sphere3);
      $point = $trilateration->position();

      print_r($point);

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
