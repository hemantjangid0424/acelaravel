<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public $modelObject;

    public function abort(){
        return redirect('/404');
    }
}
