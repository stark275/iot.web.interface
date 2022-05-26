<?php

namespace App\Http\Controllers;

use App\Models\Iot;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IotController extends Controller
{
    public function monitor()
    {
        $values = Iot::take(10)->get(['val','created_at']);

        return view('iot.monitor',[
            'data' => $values
        ]);
    }

    public function create($value)
    {
       $insert =  Iot::create([
            'val' => $value
       ]);

       return response('',Response::HTTP_NO_CONTENT);
    }

    public function getLastValue()
    {
       return (Iot::orderBy('created_at', 'desc')->first()) ;
    }
}
