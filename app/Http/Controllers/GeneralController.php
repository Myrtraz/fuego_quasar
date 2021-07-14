<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tuupola\Trilateration\Intersection;
use Tuupola\Trilateration\Sphere;

class GeneralController extends Controller
{
    public function home()
    {
        return view('location');
    }

    public function getLocation()
    {
    $kenobi= ['', 'este', '', 'un', 'mensaje'];
    $sphere1 = new Sphere(-500.0, -200.0, 100.0);
    $sphere2 = new Sphere(100.0, -100.0, 115.5);
    $sphere3 = new Sphere(500.0, 100.0, 142.7);

    $trilateration = new Intersection($sphere1, $sphere2, $sphere3);
    $point = $trilateration->position();

    print_r($point);
    print_r($kenobi);
}

    public function getMessage()
    {
        $kenobi= [' ' ,'este', ' ', 'un', 'mensaje'];
        $skywalker= ['este', ' ', 'un', '', 'mensaje'];
        $sato= ['', '', 'es', '', 'mensaje']; 

        print_r($kenobi);
        print_r($skywalker);
        print_r($sto);
    }
}
