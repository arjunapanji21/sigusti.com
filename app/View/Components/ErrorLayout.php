<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ErrorLayout extends Component
{
    public function render()
    {
        return view('layouts.error');
    }
}
