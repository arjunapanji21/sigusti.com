<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    public function terms()
    {
        return view('pages.legal.terms');
    }

    public function privacy()
    {
        return view('pages.legal.privacy');
    }
}
