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
        
        if (! empty($input['satellites'][0]) && ! empty($input['satellites'][1]) && ! empty($input['satellites'][2]) == true) {
          $array = array(
            $input['satellites'][0]['message'],
            $input['satellites'][1]['message'],
            $input['satellites'][2]['message']
          );

          foreach(array_map('array_filter', $array) as $item) {
            foreach($item as $key => $value) {
              $message[] = $value;
            }
          }

          $sphere1 = new Sphere(-500.0, -200.0, $input['satellites'][0]['distance']);
          $sphere2 = new Sphere(100.0, -100.0, $input['satellites'][1]['distance']);
          $sphere3 = new Sphere(500.0, 100.0, $input['satellites'][2]['distance']);
  
          $trilateration = new Intersection($sphere1, $sphere2, $sphere3);
          $point = $trilateration->position();

          print_r($point);
          return response()->json($message);

        } else {

          return abort(404, "Este satelite no existe o ha sido destruido");
        }
      
    }

    public function topsecret_split_name(Request $request)
    {
      $input = $request->all();
      $array = array(
        'name' =>  request()->satellite_name,
        'distance' => $input['distance'],
        'message' => $input['message']
      );

      return response()->json($array);
    }

    public function topsecret_split(Request $request)
    {
      $input = $request->all();
      $array = array(
        $input['satellites'][0]['message'],
        $input['satellites'][1]['message'],
        $input['satellites'][2]['message']
      );
      
      foreach(array_map('array_filter', $array) as $item) {
        foreach($item as $key => $value) {
          $message[] = $value;
        }
      }
      
        $sphere1 = new Sphere(-500.0, -200.0, $input['satellites'][0]['distance']);
        $sphere2 = new Sphere(100.0, -100.0, $input['satellites'][1]['distance']);
        $sphere3 = new Sphere(500.0, 100.0, $input['satellites'][2]['distance']);

        $trilateration = new Intersection($sphere1, $sphere2, $sphere3);
        $point = $trilateration->position();

      print_r($point);
      return response()->json($message);
    }
}
