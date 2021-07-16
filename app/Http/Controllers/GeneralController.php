<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tuupola\Trilateration\Intersection;
use Tuupola\Trilateration\Sphere;
use App\Modal\Satellites;

class GeneralController extends Controller
{

    public function webhook(Request $request)
    {
        $satellites = Satellites::get();
        //dd($satellites->name);
        $params = $request->all();
        $satellite = Satellites::where('id', $params['referenceId'])->first();
        //dd($satellite->name == 'kenobi');

        if (empty($satellite)) {
            return abort(404, 'no existe');

        } else {
            if ($satellite->name == 'kenobi') {

                return response()->json(['position' => "{'x' => -500.0, 'y' = -200.0}", 'message' => 'este es un mensaje secreto']);
            } elseif ($satellite->name == 'skywalker') {

                return response()->json(['position' => "{'x' => 100.0, 'y' = -100.0}", 'message' => 'este es un mensaje secreto']);
            } elseif ($satellite->name == 'sato') {

                return response()->json(['position' => "{'x' => 500.0, 'y' = 100.0}", 'message' => 'este es un mensaje secreto']);
            }
            return abort(404, ' no se pueda determinar la posición o el mensaje');
        }

        return $satellites;
    }
    
    public function getLocation()
    {
        
    $sphere1 = new Sphere(-500.0, -200.0, 100.0);
    $sphere2 = new Sphere(100.0, -100.0, 115.5);
    $sphere3 = new Sphere(500.0, 100.0, 142.7);

    $trilateration = new Intersection($sphere1, $sphere2, $sphere3);
    $point = $trilateration->position();

    print_r($point);
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

/*
public function webhook(Request $request)
    {
        $params = $request->all();
        $order = Woocommerce_orders::where('woocommerce_order_id', $params['referenceCode'])->first();
        $orderId = Orders::where('id', $order->order_id)->first();

        if(! empty($order)) {

            $payment =Payments::create([
                'order_id' => $order->order_id,
                'transactions_id' => null,
                'payment_method_id' => $orderId->payment_method_id,
                'state' => '',
                'payload' => json_encode($params),
            ]);

            return $payment;
        }

        return abort(400);
    }


*/