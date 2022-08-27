<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorViewPageController extends Controller
{
    public function unauthorized()
    {
        return view('panel.error.401');
    }
}
