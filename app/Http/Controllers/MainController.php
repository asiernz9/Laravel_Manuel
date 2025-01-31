<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public function __invoke(){
        $nombre ="Asier Campeón!!!!";
        $fecha =date("Y-m-d H:i:s");
        $numero = rand(1,10);
        return view('index',compact('nombre','fecha','numero'));





    }
}
