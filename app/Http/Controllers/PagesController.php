<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function admin()
    {
        return view('admin');
    }
    
    public function web()
    {
        return view('web');
    }
    
}
