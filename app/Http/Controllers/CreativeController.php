<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreativeController extends Controller
{
    public function view()
    {
        return view("admin.creative.view");
    }
}
