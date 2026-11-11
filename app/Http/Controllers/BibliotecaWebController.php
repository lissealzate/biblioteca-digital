<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BibliotecaWebController extends Controller
{
    //Contolador mostrar paágina web 
    public function index()
    {
        return view('biblioteca.index');
    }
}
