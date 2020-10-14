<?php

namespace App\Http\Controllers;

require '../vendor/autoload.php';

class HomeController extends Controller
{
    
    //トップページ表示
    public function index()
    {
        return view('home');
    }
}
