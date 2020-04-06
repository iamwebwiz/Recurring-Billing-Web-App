<?php

namespace App\Http\Controllers;

class FrontController extends Controller
{
    public function index()
    {
        return redirect()->route('login');
    }
}
